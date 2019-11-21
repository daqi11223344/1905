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
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('pay/save')}}" method="post" class="reg-login">
     @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="addres_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" name="addres_datail" placeholder="详细地址" /></div>
       <div class="lrList">
        <select class="area" name="county">
        <option value="0" selected="selected">请选择...</option>
          @foreach($areaInfo as $k=>$v)
            <option value="{{$v->region_id}}">{{$v->region_name}}</option>
          @endforeach
        </select>
       
       
        <select class="area" name="provincec">
        <option value="0" selected="selected">请选择...</option>
        </select>
       
       
        <select class="area" name="city">
        <option value="0" selected="selected">请选择...</option>
        </select>
       
       
        <select class="area" name="area">
        <option value="0" selected="selected">请选择...</option>
        </select>
    </div>
       <div class="lrList"><input type="tel" name="addres_tel" placeholder="手机" /></div>
       
       <td align="right" colspan="4">
                      <input type="checkbox" name="is_default" value="1"/>设置为默认地址
                    </td>
      
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl class="ftnavCur">
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
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
        $(document).on("change",".area",function(){
          var _this = $(this);
          
          var parent_id = _this.val();
          // alert(region_id);
          $.post(
              "{{url('pay/getArea')}}",
              {parent_id:parent_id},
              function(data){
                if(!data.code=='00000'){
                  var str = '<option value="0" selected="selected">请选择...</option>';
                  $.each(data.data,function(i,val){
                    str+='<option value='+val.region_id+'>'+val.region_name+'</option>';
                    // alert(str);
                  });
                  _this.next().html(str);
                  // alert(_this);
                }
              },'json');
        })
      })
  </script>
</html>