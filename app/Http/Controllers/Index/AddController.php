<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Deng;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function index(){
        return view('index.add.index');
    }

    public function reg(){
        $post = request()->except('_token');
        $post['pwd'] = encrypt($post['pwd']);
        $res = Deng::create($post);
        // dd($res);
        return view('index.add.login');
    }

    public function login(){
        return view('index.add.login');
    }

    public function logi(){
        $post = request()->except('_token');
        $res = Deng::where(['admin_name'=>$post['admin_name']])->first();
        // if($post['pwd']!=decrypt($res->pwd)){
        //     return redirect('/add/logi')->with('msg','密码错误');
        // }
        session(['admin'=>$res]);
        // dd($res);
        return redirect('/add/list');
            
    }

    public function list(){
        return view('index.add.list');
    }
}
