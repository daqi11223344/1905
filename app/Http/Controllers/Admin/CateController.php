<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;
use App\Http\Requests\StoreBrandPost;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['cate_name','like',"%$name%"];
        }
       
        $data = Cate::where($where)->get();

        
        $query = request()->all();
        $data = Cate::get();
        $data = goods($data);

        return view('admin.cate.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::get();
        $cate = goods($cate);
        // dd($cate);
        return view('admin.cate.create',['cate'=>$cate]);

        
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
       $validator = \Validator::make($post, [
        'cate_name' => 'required|unique:category',
       ],[
           'cate_name.required'=>'商品分类必填',
           'cate_name.unique'=>'分类已存在php',
       ]);
    if ($validator->fails()) {
        return redirect('cate/create')
        ->withErrors($validator)
        ->withInput();
    }
    
        $cate = Cate::create($post);
        if($cate){
            return redirect('/cate/index');
        }

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

        $data = Cate::where('cate_id',$id)->first();
 
        $cate = Cate::get();
        $cate = goods($cate);
        // dd($cate);
        return view('admin.cate.edit',['data'=>$data,'cate'=>$cate]);
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
        $validator = \Validator::make($post, [
            'cate_name' => 'required|unique:category',
           ],[
               'cate_name.required'=>'商品分类必填',
               'cate_name.unique'=>'分类已存在php',
           ]);
        if ($validator->fails()) {
            return redirect('cate/create')
            ->withErrors($validator)
            ->withInput();
        }
        Cate::where('cate_id',$id)->update($post);
        return redirect('/cate/index');
        
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

        $data = Cate::where('cate_id',$id)->delete();
        if($data){
            return redirect('/cate/index');
        }

    }

    // 唯一性验证
    public function checkOnly(){
        $cate_name = request()->cate_name;
        
        $count = Cate::where('cate_name',$cate_name)->count();
        echo $count;
        // if($count){
        //     return redirect('/cate/index');
        // }
    }
}
