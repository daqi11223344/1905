<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AD;
use App\Admin;
use App\Http\Requests\StoreBrandPost;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
        // 搜索品牌名称
        $word = request()->word;
        $where = [];
        if($word){
            $where[] = ['admin_name','like',"%$word%"];
        }
        // 搜索品牌留言
        $mobile = request()->mobile;
        if($mobile){
            $where[] = ['admin_mobile','like',"%$mobile%"];
        }

        $data = Admin::where($where)->paginate($pageSize);
        $query = request()->all();
        // dump($query);
        

        return view('admin.admin.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
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
        // dd($post);


        $validator = \Validator::make($post, [
            'admin_name' => 'required|unique:admin|max:12|alphaDash',
            'admin_email' => 'required',
            'admin_pwd' => 'required',
            // 'admin_repwd'=>'required|confirm:admin_pwd',
        ],[
            'admin_name.required'=>'管理员名称必填',
            'admin_name.unique'=>'管理员名称已存在12',
            'admin_name.max'=>'管理员名称最多不能超过12个字',
            'admin_name.alphaDash'=>'管理员名称只能包含字母、数字、破折号和下划线',
            'admin_email.required'=>'管理员邮箱必填',
            'admin_pwd.required'=>'管理员密码必填',
            // 'admin_repwd.confirm'=>'两次密码不一致',
        ]);
        if ($validator->fails()) {
            return redirect('admin/create')
            ->withErrors($validator)
            ->withInput();
        }

        // 文件上传
        if($request->hasFile('admin_photo')){
            $post['admin_photo'] = $this->upload('admin_photo');
        }

        $post['salt'] = createSalt();
        $post['admin_pwd'] = md5(md5($post['admin_pwd']).$post['salt']);
        // dd($post);
        // dd($post);

        // ORM 添加
        $admin = Admin::create($post);

        if($admin->admin_id){
            return redirect('/admin/index');
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

        // ORM 
        $data = Admin::where('admin_id',$id)->first();
        // dd($data);
        return view('admin.admin.edit',['data'=>$data]);
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
        // 接值
        $post = $request->except('_token');      
        // 判断有无文件上传
        if($request->hasFile('admin_photo')){
            $post['admin_photo'] = $this->upload('admin_photo');
        }

       
        // 更新数据库
        Admin::where('admin_id',$id)->update($post);
        return redirect('/admin/index');
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
        $res = Admin::where('admin_id',$id)->delete();
        if($res){
            return redirect('/admin/index');
        }
    }

     // 唯一性验证
     public function checkOnly(){
        $admin_name = request()->admin_name;
        
        $count = Admin::where('admin_name',$admin_name)->count();
        echo $count;
        // if($count){
        //     return redirect('/admin/index');
        // }
    }

    
}

