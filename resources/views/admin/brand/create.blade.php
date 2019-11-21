<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加商品品牌</title>
</head>
<body>
@include('admin/public/head')
    <h1>添加商品品牌</h1>
        <form action="{{url('/brand/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
            <div class="form-group has-warning">
                <label class="col-sm-2 control-label" for="inputSuccess">品牌名称</label>
                <div class="col-sm-10">
                    <input type="text" name="brand_name" class="form-control" id="firstname" placeholder="请输入品牌名称">
                    <b style="color:red">@php echo $errors->first('brand_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
                <div class="col-sm-10">
                    <input type="text" name="brand_url" class="form-control" id="brand_url" placeholder="请输入品牌网址">
                    <b style="color:red">@php echo $errors->first('brand_url');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
                <div class="col-sm-10">
                    <input type="file" name="brand_LOGO" class="form-control">
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="brand_desc" rows="3" placeholder="请进行品牌描述"></textarea>
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
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#firstname').blur(function(){
            // alert(123);
            var brand_name = $(this).val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(brand_name)){
                $(this).parent().addClass('has-error');
                $(this).next().text('品牌名称不符合规范');
                return;
        }
        
        // 唯一性验证
        $.ajax({
            method:"POST",
            url:"{{url('/brand/checkOnly')}}",
            data:{brand_name:brand_name}
        }).done(function(msg){
            // alert("Data Saved:"+msg);
            if(msg > 0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('品牌名称已存在ajax');
            }
        });
    });

        // 品牌网址
        $('#brand_url').blur(function(){
            var brand_url = $(this).val();
            var reg = /^https?:\/\/?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
            if(!reg.test(brand_url)){
                $(this).parent().addClass('has-error');
                $(this).next().text('品牌网址不符合规范');
                return;
            }
        });

        $('.btn-default').click(function(){
            var brand_name = $('#firstname').val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(brand_name)){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('品牌名称不符合规范');
                return;
            }
            var flag = true;
        // 唯一性验证
        $.ajax({
            method:"POST",
            url:"{{url('/brand/checkOnly')}}",
            async:false,
            data:{brand_name:brand_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('品牌名称已存在ajax');
                flag = false;
            }
        });
            if(!flag){
                return;
            }

            var brand_url = $('#brand_url').val();
            var reg = /^https?:\/\/?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
            if(!reg.test(brand_url)){
                $('#brand_url').parent().addClass('has-error');
                $('#brand_url').next().text('品牌网址不符合规范');
                return;
            }
            $('form').submit();
        });


</script>
</html>