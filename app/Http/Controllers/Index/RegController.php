<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RegController extends Controller
{
    public function reg(){
        return view('index.login.reg');
    }

    public function create(){

        $post = request()->except('_token');
        $ses=session('code');
        if($ses!=$post['code']){
            $data="您的验证码不对";
            return view('index.login.reg',['data'=>$data]);
        }
        $post['name'] = $post['email'];
        // $post['reg_time'] = time();
        $post['password'] = bcrypt($post['password']);
        $res = User::create($post);
        // dd($res);
        return view('index.login.login');
    }

    public function send(){
        $email =  request()->input('email');
        // echo $reg_email;die;

        $code  =rand(10000,99999);
        $message = "接：".$code;
         $this->sendemail($email,$message);
            session(['code'=>$code]);
            echo session('code');
    }
    

    public function sendemail($email,$message){
        \Mail::raw($message,function($message)use($email){
        //设置主题
            $message->subject("熊孩！");
        //设置接收方
            $message->to($email);
        });
    }
}
