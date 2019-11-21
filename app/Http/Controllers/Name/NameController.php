<?php

namespace App\Http\Controllers\Name;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class NameController extends Controller
{
    public function login(){
        return view('name.name.login');
    }

    public function create(){
        $post = request()->except('_token');
        // dd($post);
        $name = $post['name'];
        $password = $post['password'];
        $where = [
            ['name','=',$name],
            ['password','=',$password]
        ];
        // dd($where);

        $link = User::where($where)->first();
        // dd($link);
        if(Auth::attempt(['name'=>$name,'password'=>$password])){
            return redirect('/index/index');
        }else{
            $links = '您的用户名或密码不正确，请重试';
            return view('name.name.login',['links'=>$links]);
        }
    }
}
