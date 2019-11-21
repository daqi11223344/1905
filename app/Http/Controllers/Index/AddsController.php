<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Adds as Ad;
use App\Deng;

class AddsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()){
            return redirect('add/login');
         }

         $data = Ad::get();

         return view('index.adds.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()){
            return redirect('add/login');
         }
        return view('index.adds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()){
            return redirect('add/login');
         }
         $id = Auth::id();
         $post = request()->except('_token');
         
         $where = [
             ['id','=',$id],
             ['is_show','=',1]
         ];
        //  dd($where);
         if($request->hasFile('h_img')){
             $post['h_img'] = $this->uplode('h_img');
         }
         $post['h_time'] = time();
         $post['id'] = $id;
         $data = Ad::where($where)->create($post);
        //  dd($data);
        if($data -> h_id){
            return redirect('/adds/index');
        }

    }

    public function uplode($filename){
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
    public function show()
    {
        $show = Deng::get();
        // dd($show);
        return view('index.adds.show',['show'=>$show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
