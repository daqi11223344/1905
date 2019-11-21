@extends('layouts.shop')
@section('title','珠宝商-登陆页面')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员登陆</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('login/creat')}}" method="post" class="reg-login">
     @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('login/reg')}}">注册</a></h3>
      <div class="lrBox">
           {{$links??''}}
       <div class="lrList"><input type="text" name="email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" name="password" placeholder="输入验证码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     @include('index.public.footer')
     @endsection
