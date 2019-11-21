@extends('layouts.shop')
@section('title','珠宝商')
@section('content')
     <div class="head-top">
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_201911091100071.jpg" />
      <dl>
       <dt><a href="user.html"><img src="{{env('UPLOAD_URL')}}upload/微信图片_20191106164248.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('login/login')}}">登录</a></li>
      <li><a href="{{url('login/reg')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000710.jpg" />
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000715.jpg" />
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000714.jpg" />
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000712.jpg" />
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000713.jpg" />
     </div><!--sliderA/-->
     <ul class="pronav">
          @foreach($cate as $k=>$v)
               <li><a href="">{{$v->cate_name}}</a></li>
          @endforeach

      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
      @foreach($data as $k=>$v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('login/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$v->goods_photo}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('login/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a></dd>
        <dd class="ip-price"><strong>¥{{$v->goods_price}}</strong> <span>¥{{$v->goods_price}}</span></dd>
       </dl>
      </div>
     @endforeach
      <!-- <div class="clearfix"></div> -->
     <!-- </div>index-pro1/
     <div class="prolist">
      <dl>
       <dt><a href="proinfo.html"><img src="/static/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      <dl>
       <dt><a href="proinfo.html"><img src="/static/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      <dl>
       <dt><a href="proinfo.html"><img src="/static/index/images/prolist1.jpg" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">四叶草</a></h3>
        <div class="prolist-price"><strong>¥299</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
     <!-- </div>prolist/ -->
     <div class="joins"><a href="fenxiao.html"><img src="{{env('UPLOAD_URL')}}upload/47841843574895679.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     @include('index.public.footer')
    @endsection