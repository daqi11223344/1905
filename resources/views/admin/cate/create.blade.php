<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>商品分类添加</title>
</head>
<body>
@include('admin/public/head')
    <h1>商品分类添加</h1>
<form action="{{url('/cate/store')}}" method="post" >
@csrf
<div class="form-group has-warning">
                <label class="col-sm-2 control-label" for="lastname">分类名称</label>
                <div class="col-sm-10">
                    <input type="text" name="cate_name" class="form-control" id="firstname" placeholder="请输入分类名称">
                    <b style="color:red">@php echo $errors->first('cate_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">顶级分类</label>
                    <select name="parent_id" id="">
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
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">是否显示分类</label>
                <label class="radio-inline">
                            <input type="radio" name="is_show"  value="1" checked/>是
                </label>
                <label class="radio-inline">
                            <input type="radio" name="is_show"  value="0" />否
                </label>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">导航分类</label>
                <label class="radio-inline">
                            <input type="radio" name="is_nav_show"  value="1" checked/>是
                </label>
                <label class="radio-inline">
                            <input type="radio" name="is_nav_show"  value="0" />否
                </label>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">关键词</label>
                <div class="col-sm-10">
                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="请输入关键词">
                    <b style="color:red">@php echo $errors->first('keywords');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="desc" rows="3" placeholder="请进行分类描述"></textarea>
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
            var cate_name = $(this).val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(cate_name)){
                $(this).parent().addClass('has-error');
                $(this).next().text('分类名称不符合规范');
                return;
        }
        
        // 唯一性验证
        $.ajax({
            method:"POST",
            url:"{{url('/cate/checkOnly')}}",
            data:{cate_name:cate_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('分类名称已存在js');
            }
        });
    });
        $('.btn-default').click(function(){
            var cate_name = $('#firstname').val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(cate_name)){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('分类名称不符合规范');
                return;
            }
            var flag = true;
        // 唯一性验证
        $.ajax({
            method:"POST",
            url:"{{url('/cate/checkOnly')}}",
            async:false,
            data:{cate_name:cate_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('分类名称已存在js');
                flag = false;
            }
        });
            if(!flag){
                return;
            }
            $('form').submit();
        });


</script>
</html>