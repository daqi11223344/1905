<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;

use function Opis\Closure\serialize;
use function Opis\Closure\unserialize;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $user = \Auth::user();
        // $id = \Auth::id();
        // dd($id);

        // getAll();
        $page = request()->page??1;
        $word = request()->word??'';
        $desc = request()->desc??'';
        // echo 'data_'.$page.'_'.$word.'_'.$desc;
        // $data = Cache::get('data_'.$page.'_'.$word.'_'.$desc);
        $data = Redis::get('data_'.$page.'_'.$word.'_'.$desc);
        // dump($data);
        if(!$data){
            // echo "db===";
            $pageSize = config('app.pageSize');
            // 搜索品牌名称
            $word = request()->word;
            $where = [];
            if($word){
                $where[] = ['brand_name','like',"%$word%"];
            }
            // 搜索品牌留言
            $desc = request()->desc;
            if($desc){
                $where[] = ['brand_desc','like',"%$desc%"];
            }

            // DB::connection()->enableQueryLog();
            $data = Brand::where($where)->paginate($pageSize);
            // $logs = DB::getQueryLog();
            // dump($logs);

            // Cache::put('data_'.$page.'_'.$word.'_'.$desc,$data,60);
            $data = serialize($data);
            Redis::set('data_'.$page.'_'.$word.'_'.$desc,$data,60);
            
        }
        $data = unserialize($data);
        // dump($query);
        $query = request()->all();

        return view('admin.brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo 123;
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 第二种验证
    // public function store(\App\Http\Requests\StoreBrandPost $request)
    public function store(Request $request)
    {

    // 第一种验证
    //    $request->validate([
    //         'brand_name' => 'required|unique:posts',
    //         'brand_url' => 'required',
    //    ],[
    //        'brand_name.required'=>'品牌名称必填',
    //        'brand_name.unique'=>'品牌名称已存在',
    //        'brand_url.required'=>'品牌网址必填',
    //    ]);

        // 接受排除_token的值
        $post = $request->except('_token');


        $validator = \Validator::make($post, [
            'brand_name' => 'required|unique:brand|max:12|alphaDash',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_name.max'=>'品牌名称最多不能超过12个字',
            'brand_name.alphaDash'=>'品牌名称只能包含字母、数字、破折号和下划线',
            'brand_url.required'=>'品牌网址必填',
        ]);
        if ($validator->fails()) {
            return redirect('brand/create')
            ->withErrors($validator)
            ->withInput();
        }
        
        // 只接受某个字段的值
        // $post = $request->only(['brand_name','brand_url']);
        // dump($post);
        // unset($post['_token']);
        // $res = DB::table('brand')->insert($post); //返回布尔值

        // $res = DB::table('brand')->insertGetId($post);
        // dd($res);

        // 文件上传
        if($request->hasFile('brand_LOGO')){
            $post['brand_LOGO'] = $this->upload('brand_LOGO');
        }
        // dd($post);

        // ORM 添加
        $brand = Brand::create($post);
        // echo $brand->brand_id;

        // $brand = new Brand;
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        // $brand->brand_LOGO = $post['brand_LOGO'];
        // $brand->brand_desc = $post['brand_desc'];
        // $brand->save();

        if($brand->brand_id){
            return redirect('/brand/index');
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isValid()){
            $photo = request()->file($filename);
            $store_result = $photo->store('photo');
            return $store_result;
        }
        exit('为获取到上传文件或过程出错');
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

        // $data = DB::table('brand')->where('brand_id',$id)->first();

        // ORM 
        $data = Brand::where('brand_id',$id)->first();
        // dd($data);
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandPost $request, $id)
    {
        // 验证
        // 接值
        $post = $request->except('_token');
        // 判断有无文件上传
        if($request->hasFile('brand_LOGO')){
            $post['brand_LOGO'] = $this->upload('brand_LOGO');
        }
        // 更新数据库
         Brand::where('brand_id',$id)->update($post);
        return redirect('/brand/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$id){
            abort(404);
        }

        // DB 删除
        // $res = DB::table('brand')->where('brand_id',$id)->delete();

        // ORM 删除
        // $res = Brand::destroy($id);
        $res = Brand::where('brand_id',$id)->delete();
        if($res){
            return redirect('/brand/index');
        }
    }

    // 唯一性验证
    public function checkOnly(){
        $brand_name = request()->brand_name;
        
        $count = Brand::where('brand_name',$brand_name)->count();
        echo $count;
        // if($count){
        //     return redirect('/brand/index');
        // }
    }
}
