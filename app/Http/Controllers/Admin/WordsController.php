<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catee;
use App\Word;
use Illuminate\Validation\Rule;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');

        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['word_name','like',"%$name%"];
        }
        // 搜索品牌留言
        $cate_id = request()->cate_id;
        if($cate_id){
            $where[] = ['word.cate_id','=',"$cate_id%"];
        }
        $cate = Catee::get();
        $data = Word::where($where)->join('cate','word.cate_id','=','cate.cate_id')->paginate($pageSize);
        $query = request()->all();
        return view('admin.word.index',['data'=>$data,'cate'=>$cate,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Catee::get();   
        return view('admin.word.create',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->except('_token');
        if($request->hasFile('word_file')){
            $post['word_file'] = $this->upload('word_file');
        }
        $validator = \Validator::make($post, [
            'word_name' => 'required|unique:word|max:20|alphaDash',
            'cate_id' => 'required',
        ],[
            'word_name.required'=>'文章标题必填',
            'word_name.unique'=>'文章标题已存在php',
            'word_name.max'=>'商品名称最多不能超过20个字',
            'word_name.alphaDash'=>'文章标题只能包含字母、数字、破折号和下划线',
            'cate_id.required'=>'文章分类必填',
        ]);
        if ($validator->fails()) {
            return redirect('word/create')
            ->withErrors($validator)
            ->withInput();
        }
        $post['word_time'] = time();
        // dd($post);
        $word = Word::create($post);
        
        if($word->word_id){
            return redirect('/word/index');
        }

    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = request()->file($filename);
            $store_result = $photo->store('photo');
            return $store_result;
        }
        exit('未获取到上传文件或过程出错');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$id){
            abort(404);
        }
        $cate = Catee::get();
        $word = Word::where('word_id',$id)->first();
        return view('admin.word.edit',['word'=>$word,'cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
        // 判断有无文件上传
        if($request->hasFile('word_file')){
            $post['word_file'] = $this->upload('word_file');
        }

           $request->validate([
            'word_name' => [
                'required',
                Rule::unique('word')->ignore($id,'word_id'),
            ],
            'cate_id' => 'required',
       ],[
           'word_name.required'=>'品牌名称必填',
           'word_name.unique'=>'品牌名称已存在',
           'cate_id.required'=>'品牌网址必填',
       ]);

        // 更新数据库
        
         Word::where('word_id',$id)->update($post);
        return redirect('/word/index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $word_id = request()->input('word_id');
        if(!$word_id){
            abort(404);
        }
        // $word = Word::where('word_id',$id)->delete();
        // if($word){
        //     return redirect('/word/index');
        // }

       
    		$res = Word::destroy($word_id);
    		if($res){
    			echo json_encode(['code'=>'00000','msg'=>'删除成功']);
    		}
    }

     // 唯一性验证
     public function checkOnly(){
        $word_name = request()->input('word_name');
        $word_id = request()->input('word_id');
        $where=[];
        if($word_id){
            $where[]=['word_id','<>',$word_id];
        }
        $where[]=['word_name','=',$word_name];
        $count = Word::where($where)->count();
        // echo $count;
        if($count){
            $result = ['code'=>'00000','msg'=>'更新成功'];
            echo json_encode($result);
        }
    }
}
