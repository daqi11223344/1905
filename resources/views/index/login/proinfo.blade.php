<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="{{asset('/static/index/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/static/index/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/static/index/css/response.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
        @php
          $str=explode('|',$data->goods_imgs);
        @endphp
        @foreach ($str as $val)
          <img src="{{env('UPLOAD_URL')}}{{$val}}" alt="" width="70">
        @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$data->goods_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" id="buy_number" goods_num = "{{$data->goods_num}}" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$data->goods_name}}</strong>
        <p class="hui">{{$data->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOAD_URL')}}{{$data->goods_photo}}" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id="addCart">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>
    <!--焦点轮换-->
    <script src="{{asset('/static/index/js/jquery.excoloSlider.js')}}"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>

    <script>
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // 加入购物车
      $(document).on('click','#addCart',function(){
        var goods_id = "{{$data->goods_id}}";
        var buy_number = parseInt($('#buy_number').val());
        $.post(
          "{{url('login/addCart')}}",
          {goods_id:goods_id,buy_number:buy_number},
          function(data){
          if(data.code=='00000'){
            if(window.confirm(data.data)){
              location.href="{{url('login/login')}}";
            }
          }
          if(data.code=='2'){
            alert(data.data);
          }
          else if(data.code=='1'){
            alert(data.data);
              location.href="{{url('cart/cart')}}";
          }
        },'json');
      })
    //加号 
      $(document).on('click','.increase',function(){
        // alert(123);
        var goods_num = parseInt($('#buy_number').attr('goods_num'));
        var buy_number = parseInt($('#buy_number').val());
        if(buy_number >= goods_num){
          // alert(123);
          $('#buy_number').val(goods_num);
        }else{
          // alert(123);
          buy_number = buy_number + 0;
          $('#buy_number').val(buy_number);
        }
      });
      // 减号
      $(document).on('click','.decrease',function(){
        // alert(1234);
        var buy_number = parseInt($('#buy_number').val());
        if(buy_number<=1){
          // alert(23);
          $('#buy_number').val(1);
        }else{
          // alert(1234);
          buy_number = buy_number - 0;
          $('#buy_number').val(buy_number);
        }
      });
    // 文本框
      $(document).on('blur','#buy_number',function(){
        // alert(123);return;
        var goods_num = parseInt($('#buy_number').attr('goods_num'));
        var buy_number = parseInt($('#buy_number').val());
        var reg = /^\d+$/;
        if(!reg.test(buy_number)||parseInt(buy_number)<0){
          // alert(reg);return;
          $('#buy_number').val(1);
        }else if (parseInt(buy_number) >= goods_num) {
          $('#buy_number').val(goods_num);
        }else{
          buy_number = parseInt(buy_number);
          // alert(buy_number);return;
          $('#buy_number').val(buy_number);
        }
      });
    </script>


</html> 
@include('index.public.footer')