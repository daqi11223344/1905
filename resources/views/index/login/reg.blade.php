@extends('layouts.shop')
@section('title','珠宝商-登陆页面')
@section('content')
<script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('login/create')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="email" placeholder="输入手机号码或者邮箱号" id="email" /></div>
       {{$data??''}}
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <a href="javascript:;" id="code">获取验证码</a></div>
       <div class="lrList"><input type="password" name="password" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <!-- <div class="lrList"><input type="password" name="reg_repwd" placeholder="再次输入密码" /></div> -->
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
     
    
    $('#code').click(function(){
      // alert(1234);
      var email = $('#email').val();
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.post('{{url('login/send')}}',{
        email:email
      },function(data){
      
        alert(data);
      });
    });
     
     </script>
     @include('index.public.footer')

@endsection
