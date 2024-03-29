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
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
     <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000713.jpg" width="640" height="269"/>
     </div><!--head-top/-->
     <div class="dingdanlist">
        <table border="0" class="peo_tab">        
        @foreach ($data as $k=>$v)
       <tr>
          <td>
            <input type="radio" name="addres_id" {{$v->is_default==1?'checked':''}} addres_id="{{$v->addres_id}}">
          </td>
          <td>{{$v->addres_name}} {{$v->addres_tel}}</td>
          <td>{{$v->country}}{{$v->provincec}}{{$v->city}}{{$v->area}}{{$v->addres_datail}}</td>
          </td>
      </tr>
       @endforeach
       <tr>
        <td class="dingimg" width="75%" colspan="2">
          <a href="{{url('pay/addres')}}">新增收货地址</a>
        </td>

        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <!-- <tr>
        <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr> -->
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
       <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right"><span class="hui">支付宝支付</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">订单留言</td>
        <td align="right">
        <textarea class="add_txt" id="order_talk"></textarea>
        </td>
       </tr>
       <!-- 
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
        <td align="right"><span class="hui">个人</span></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr> -->
        @foreach($info as $k=>$v)
          <tr goods_id = "{{$v->goods_id}}">
            <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_photo}}" width="127" height="73"/></td>
            <td width="50%">
            <h3>{{$v->goods_name}}</h3>
            <time>{{date('Y-m-d H:i:s',$v->add_time)}}</time>
            </td>
            <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
          </tr>
          <tr>
            <th colspan="3"><strong class="orange">¥{{$money}}</strong></th>
          </tr>
        @endforeach
       
       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange">¥{{$money}}</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange">¥20.80</strong></td>
       </tr>
      </table>
      
     
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥{{$money}}</strong></td>
       <td width="40%"><a href="javascript:;" id="submitOrder" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>
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
      $(document).ready(function(){
        // $(document).on("click",".pay>li",function(){
        //   var _this = $(this);
        //   _this.addClass('checked').siblings("li").removeClass('checked');
        //   alert(_this);
        // })
      })
      $(document).on('click','#submitOrder',function(){
        // alert(132);
        var _tr = $("tr[goods_id]");
        var goods_id = "";
        _tr.each(function(index){
          goods_id += $(this).attr('goods_id')+',';
        })
        goods_id = goods_id.substr(0,goods_id.length-1);
        var addres_id = $(":radio:checked").attr('addres_id');
        var pay_type = $('span').text();
        var order_talk = $("#order_talk").val();
        location.href = "{{url('pay/submitOrder')}}?goods_id="+goods_id+"&addres_id="+addres_id+"&pay_type="+pay_type+"&order_talk="+order_talk;
      })
  </script>
</html>