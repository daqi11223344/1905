<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加商品列表</title>
</head>
<body>
@include('admin/public/head')
    <h1>添加商品</h1>
        <form action="{{url('/goods/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
            <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
        @csrf
            <div class="form-group has-success">
                <label class="col-sm-2 control-label" for="inputSuccess">商品名称</label>
                <div class="col-sm-10">
                    <input type="text" name="goods_name" class="form-control" id="firstname" placeholder="请输入品牌名称">
                    <b style="color:red">@php echo $errors->first('goods_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-success">
                <label class="col-sm-2 control-label" for="inputSuccess">商品货号</label>
                <div class="col-sm-10">
                    <input type="text" name="goods_sn" class="form-control" id="firstname">
                    <b style="color:red">@php echo $errors->first('goods_sn');@endphp</b>
                </div>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">所属分类</label>
                <select name="cate_id" id="">
							<option value="">请选择</option>
							@foreach ($cate as $k=>$v)
								<option value="{{$v->cate_id}}">@php 
                                    echo str_repeat('*',$v->level);
                                    @endphp
                                    {{$v->cate_name}}
                                </option>
							@endforeach
						</select>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">所属品牌</label>
                <select name="brand_id" id="">
							<option value="">请选择</option>
							@foreach ($brand as $k=>$v)
								<option value="{{$v->brand_id}}">@php 
                                    echo str_repeat('*',$v->level);
                                    @endphp
                                    {{$v->brand_name}}
                                </option>
							@endforeach
						</select>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">是否上架</label>
                <label class="radio-inline">
                            <input type="radio" name="is_on_sale"  value="1" checked/>是
                </label>
                <label class="radio-inline">
                            <input type="radio" name="is_on_sale"  value="0" />否
                </label>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">是否热销</label>
                <label class="radio-inline">
                            <input type="radio" name="is_hot"  value="1" checked/>是
                </label>
                <label class="radio-inline">
                            <input type="radio" name="is_hot"  value="0" />否
                </label>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">是否新品</label>
                <label class="radio-inline">
                            <input type="radio" name="is_new"  value="1" checked/>是
                </label>
                <label class="radio-inline">
                            <input type="radio" name="is_new"  value="0" />否
                </label>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">商品价格</label>
                <div class="col-sm-10">
                    <input type="text" name="goods_price" class="form-control" id="goods_price" placeholder="请输入品牌网址">
                    <b style="color:red">@php echo $errors->first('goods_price');@endphp</b>
                </div>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">商品照片</label>
                <div class="col-sm-10">
                    <input type="file" name="goods_photo" class="form-control" id="lastname">
                </div>
            </div>
            <div class="form-group has-success">
                <label for="lastname" class="col-sm-2 control-label">商品相册</label>
                <div class="col-sm-10">
                    <input type="file" name="goods_imgs[]" class="form-control" id="lastname">
                    <span class="names"><b>[+]</b></span>
                </div>
            </div>
            <div class="form-group has-success"">
                <label for="lastname" class="col-sm-2 control-label">商品描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="goods_desc" rows="3" placeholder="请进行品牌描述"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="button" class="btn btn-default" value="添加">
                </div>
            </div>
    </form>
</body>
<script>
        $('#firstname').blur(function(){
            var goods_name = $(this).val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(goods_name)){
                $(this).parent().addClass('has-error');
                $(this).next().text('商品名称名称不符合规范');
                return;
        }
        
        // 唯一性验证
        $.ajax({
            method:"POST",
            url:"{{url('/goods/checkOnly')}}",
            data:{goods_name:goods_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('商品名称已存在');
            }
        });
    });

    
        $('#goods_price').blur(function(){
            var goods_price = $(this).val();
            var reg = /^\d+$/;
            if(!reg.test(goods_price)){
                $(this).parent().addClass('has-error');
                $(this).next().text('商品价格不符合规范');
                return;
            }
        });

        $('.btn-default').click(function(){
            var goods_name = $('#firstname').val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(goods_name)){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('品牌名称不符合规范');
                return;
            }
            var flag = true;
        // 唯一性验证
        $.ajax({
            method:"POST",
            url:"{{url('/goods/checkOnly')}}",
            async:false,
            data:{goods_name:goods_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('商品名称已存在');
                flag = false;
            }
        });
            if(!flag){
                return;
            }

            var goods_price = $('#goods_price').val();
            var reg = /^\d+$/;
            if(!reg.test(goods_price)){
                $('#goods_price').parent().addClass('has-error');
                $('#goods_price').next().text('商品价格不符合规范');
                return;
            }
            $('form').submit();

        });

        $(document).on('click','.names',function(){
            var span_c = $(this).parent().clone();
            $(this).parent().after(span_c);
            $(this).parent().next().find('b').html('[-]');
            $(this).parent().next().find('span').attr('class','nana');
        });
        $(document).on('click','.nana',function(){
            $(this).parent().remove();
        })

</script>
</html>