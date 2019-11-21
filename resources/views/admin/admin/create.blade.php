<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加管理员表单</title>
</head>
<body>
    @include('admin/public/head')
    <h1>添加管理员表单</h1>
        <form action="{{url('/admin/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                <label class="col-sm-2 control-label" for="lastname">管理员名称</label>
                <div class="col-sm-10">
                    <input type="text" name="admin_name" class="form-control" id="firstname" placeholder="请输入管理员名称">
                    <b style="color:red">@php echo $errors->first('admin_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员电话</label>
                <div class="col-sm-10">
                    <input type="tel" name="admin_mobile" class="form-control" id="admin_mobile" placeholder="请输入管理员电话">
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员邮箱</label>
                <div class="col-sm-10">
                    <input type="email" name="admin_email" class="form-control" id="admin_email" placeholder="请输入管理员邮箱">
                    <b style="color:red">@php echo $errors->first('admin_email');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员相片</label>
                <div class="col-sm-10">
                    <input type="file" name="admin_photo" class="form-control" id="admin_photo">
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员密码</label>
                <div class="col-sm-10">
                    <input type="password" name="admin_pwd" class="form-control" id="admin_pwd" placeholder="请输入管理员密码">
                    <b style="color:red">@php echo $errors->first('admin_pwd');@endphp</b>
                </div>
            </div>
            <!-- <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">确认管理员密码</label>
                <div class="col-sm-10">
                    <input type="password" name="admin_repwd" class="form-control" id="lastname" placeholder="请输入管理员密码">
                    <b style="color:red">@php echo $errors->first('admin_repwd');@endphp</b>
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <input type="button" class="btn btn-default" value="添加">
                </div>
            </div>
    </form>
</body>
<script>
        $('#firstname').blur(function(){
            var admin_name = $(this).val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(admin_name)){
                $(this).parent().addClass('has-error');
                $(this).next().text('管理员名称不符合规范');
                // return;
        }
        
        // 唯一性验证
        $.ajax({
            type:"POST",
            url:"{{url('/admin/checkOnly')}}",
            data:{admin_name:admin_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('管理员名称已存在222');
            }
        });
    });

        // 管理员邮箱
        $('#admin_email').blur(function(){
            var admin_email = $(this).val();
            var reg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
            if(!reg.test(admin_email)){
                $(this).parent().addClass('has-error');
                $(this).next().text('管理员邮箱不符合规范');
                return;
            }
        });

        // 管理员密码
        $('#admin_pwd').blur(function(){
            var admin_pwd = $(this).val();
            var reg = /^[a-z0-9_-]{6,18}$/;
            if(!reg.test(admin_pwd)){
                $(this).parent().addClass('has-error');
                $(this).next().text('管理员密码不符合规范');
                return;
            }
        });

        $('.btn-default').click(function(){
            var admin_name = $('#firstname').val();
            var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
            if(!reg.test(admin_name)){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('管理员名称不符合规范');
                return;
            }
            var flag = true;
        // 唯一性验证
        $.ajax({
            type:"POST",
            url:"{{url('/admin/checkOnly')}}",
            async:false,
            data:{admin_name:admin_name}
        }).done(function(msg){
            if(msg>0){
                $('#firstname').parent().addClass('has-error');
                $('#firstname').next().text('管理员名称已存在222');
                flag = false;
            }
        });
            if(!flag){
                return;
            }

            var admin_email = $('#admin_email').val();
            var reg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
            if(!reg.test(admin_email)){
                $('#admin_email').parent().addClass('has-error');
                $('#admin_email').next().text('管理员邮箱不符合规范');
                return;
            }

            var admin_pwd = $('#admin_pwd').val();
            var reg = /^[a-z0-9_-]{6,18}$/;
            if(!reg.test(admin_pwd)){
                $('#admin_pwd').parent().addClass('has-error');
                $('#admin_pwd').next().text('管理员密码不符合规范');
                return;
            }

            $('form').submit();
        });


</script>
</html>