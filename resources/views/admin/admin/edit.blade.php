<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>编辑管理员表单</title>
</head>
<body>
@include('admin/public/head')
    <h1>编辑管理员表单</h1>
        <form action="{{url('/admin/update/'.$data->admin_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                    <input type="text" name="admin_name" value="{{$data->admin_name}}" class="form-control" id="firstname" placeholder="请输入管理员名称">
                    <b style="color:red">@php echo $errors->first('admin_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员电话</label>
                <div class="col-sm-10">
                    <input type="tel" name="admin_mobile" value="{{$data->admin_mobile}}" class="form-control" id="lastname" placeholder="请输入管理员电话">
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员邮箱</label>
                <div class="col-sm-10">
                    <input type="email" name="admin_email" value="{{$data->admin_email}}" class="form-control" id="lastname" placeholder="请输入管理员邮箱">
                    <b style="color:red">@php echo $errors->first('admin_email');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员相片</label>
                <div class="col-sm-10">
                <img class="img-circle" src="{{env('UPLOAD_URL')}}{{$data->admin_photo}}" width="100">
                    <input type="file" name="admin_photo" class="form-control" id="lastname">
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">管理员密码</label>
                <div class="col-sm-10">
                    <input type="password" name="admin_pwd" value="{{$data->admin_pwd}}" class="form-control" id="lastname" placeholder="请输入管理员密码">
                    <b style="color:red">@php echo $errors->first('admin_pwd');@endphp</b>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
                </div>
            </div>
    </form>
</body>
</html>