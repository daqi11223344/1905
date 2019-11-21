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
      <img src="{{env('UPLOAD_URL')}}upload/微信图片_2019110911000713.jpg" width="640" height="822" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">**</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
       
        <table>
        <tr>
          <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allBox" name="1" /> 全选</a></td>
        </tr>
        @foreach($data as $k=>$v)
        <tr goods_id="{{$v->goods_id}}">
          <td width="4%"><input type="checkbox" class="box" name="1" /></td>
          <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_photo}}" /></td>
          <td width="50%">
          <h3>{{$v->goods_name}}</h3>
          <time>{{date('Y-m-d H:i:s',$v->add_time)}}</time>
          </td>
          <td align="right">
            <div goods_id="{{$v->goods_id}}" goods_num="{{$v->goods_num}}">
                <input type="button" value="-" class="decrease"/>
                <input type="text" class="buy_number" value="{{$v->buy_number}}"/>
                <input type="button" value="+" class="increase" goods_num="{$v.goods_num}"/><br>
                <!-- <span>
                单价：¥{{$v->add_price}}<br>
                </span> -->
                <a href="javascript:;" class="orange del">删除</a>
            </div>
          </td>
        </tr>
        <tr>
          <th colspan="4">
            <strong class="orange">
              ¥{{$v->add_price*$v->buy_number}}.00
            </strong>
          </th>
        </tr>

        @endforeach
        </table>
      
     </div><!--dingdanlist/-->
     
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="money">¥0</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
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

      // 全选
      $(document).on('click','#allBox',function(){
        var status = $("#allBox").prop('checked');
        // alert(status);
        $('.box').prop('checked',status);
        if(status == true){
          $('.box').each(function(index){
            $(this).parents('tr').addClass('car_tr');
            // alert($(this));
          })
        }else{
          $('.box').each(function(index){
            $(this).parents('tr').removeClass('car_tr');
          })
        }
        // 获取总价
        getCount();
      });

      // 复选框
      $(document).on('click','.box',function(){
        var status = $(this).prop('checked');
        if(status == true){
          $(this).parents('tr').addClass('car_tr');
        }else{
          $(this).parents('tr').removeClass('car_tr');
        }
        // 获取总价
        getCount();
      });

      // 减号
      $(document).on('click','.decrease',function(){
        var _this = $(this);
        // alert(123467890);
        var goods_id = _this.parents('tr').attr('goods_id');
        // alert(goods_id);
        var buy_number = parseInt(_this.next('input').val());
        // alert(buy_number);
        if(buy_number <=1 ){
          _this.next('input').val(1);
        }else{
          buy_number = buy_number - 1;
          _this.next('input').val(buy_number);
        }
         //  数据库中购物车里的数量
         changeNum(goods_id,buy_number);
         //选中复选框
         checkedTr(_this);
        // 获取小计
        getTotal(goods_id,_this);
         // 获取总价
         getCount();
      
      });

      // 加号
      $(document).on('click','.increase',function(){
        var _this = $(this);
        var goods_id = parseInt(_this.parent('div').attr('goods_id'));
        var buy_number = parseInt(_this.prev().val());
        var goods_num = parseInt(_this.attr('goods_num'));
        if(buy_number >= goods_num){
          _this.prev("input").val(goods_num);
        }else{
          buy_number = buy_number + 1;
          _this.prev("input").val(buy_number);
        }
         //  数据库中购物车里的数量
          changeNum(goods_id,buy_number);
          //选中复选框
         checkedTr(_this);
         // 获取总价
          getCount();
         // 获取小计
          getTotal(goods_id,_this); 
      });

      // 文本框
      $(document).on('blur','.buy_number',function(){
        // alert(2345);
        var _this = $(this);
        var goods_id = _this.parents('tr').attr('goods_id');
        var buy_number = _this.val();
        var goods_num = _this.parents('div').attr('goods_num');

        var reg = /^\d+$/;
        if(!reg.test(buy_number) || parseInt(buy_number<=0)){
          _this.val(1);
        }else if(parseInt(buy_number)>=parseInt(goods_num)){
          _this.val(goods_num);
        }else{
          buy_number = parseInt(buy_number);
          _this.val(buy_number);
        }
        //  数据库中购物车里的数量
        changeNum(goods_id,buy_number);
        //选中复选框
        checkedTr(_this);
        // 获取总价
        getCount();
        // 获取小计
        getTotal(goods_id,_this);
      });

      // 入库修改购买数量
      function changeNum(goods_id,buy_number){
        // alert(goods_id);
        $.ajax({
          url:"{{url('cart/changeNum')}}",
          type:'post',
          data:{
              buy_number:buy_number,
              goods_id:goods_id
          },
          async:false,
          dataType:'json'
        }).done(function(res){
          if(res.code==2){
            alert(res.alert);
          }
        })
      }

      // 选中复选框
      function checkedTr(_this){
        _this.parents('tr').addClass("car_tr");
        _this.parents('tr').find("input[class='box']").prop('checked',true);
      }

      // 获取小计
      function getTotal(goods_id,_this){
        // alert(goods_id);
        $.post(
          "{{url('cart/getTotal')}}",
          {goods_id:goods_id},
          function(res){
            _this.parents("tr").next("tr").text("￥" + res);
          }
        );
      }

      // 获取总价
      function getCount(){
        var _box = $('.box:checked');
        var goods_id = "";
        _box.each(function(index){
          goods_id += $(this).parents("tr").attr('goods_id') + ',';
        });
        goods_id = goods_id.substr(0,goods_id.length - 1);
        // console.log(goods_id);
        $.post(
          "{{url('cart/getCount')}}",
          {goods_id:goods_id},
          function(res){
            // alert(res);
            $("#money").text('￥'+res);
          }
        );
      }

      // 删除
      $(document).on('click','.del',function(){
        // alert(12345);
        var _this = $(this);
        var goods_id = _this.parents('tr').attr('goods_id');
        $.ajax({
          type:"post",
          data:{
            goods_id:goods_id
          },
          url:"{{url('cart/cartDel')}}",
          async:false
        }).done(function(res){
          if(res.code==2){
            alert(res.data);
          }else{
            _this.parents('tr').remove();
            // alert(_this);
          }
        })
        getCount();
      });

      // 订单确认
      $(document).on('click','.jiesuan',function(){
        var _box = $(".box:checked");
        // alert(_box);return;
        if(_box.length>0){
          var goods_id = "";
          _box.each(function(index){
            goods_id = goods_id+=$(this).parents("tr").attr('goods_id')+',';
          })
          goods_id = goods_id.substr(0,goods_id.length-1);
          // console.log(goods_id);
          location.href = "{{url('pay/pay')}}/"+goods_id;
        }else{
          alert("至少也要选一件像样的吧");
        }
      });
    
    </script>

</html>
