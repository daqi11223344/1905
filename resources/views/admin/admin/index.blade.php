<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>管理员列表</title>
</head>
<body>

@include('admin/public/head')
<h1>管理员列表</h1>
    <form action="">
        <input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入名称">
        <input type="text" name="mobile" value="{{$query['mobile']??''}}" placeholder="请输入电话">
        <button>搜素</button>
    </form>

<a class="btn btn-default" href="{{url('/admin/create')}}">添加</a>
    <table class="table">
        <thead>
            <tr class="warning">
                <th>管理员ID</th>
                <th>管理员名称</th>
                <th>管理员电话</th>
                <th>管理员邮箱</th>
                <th>管理员相片</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($data as $v)
                <tr @if($i%2==0) class="success" @else class="danger" @endif>
                    <td>{{$v->admin_id}}</td>
                    <td>{{$v->admin_name}}</td>
                    <td>{{$v->admin_mobile}}</td>
                    <td>{{$v->admin_email}}</td>
                    <td><img class="img-circle" src="{{env('UPLOAD_URL')}}{{$v->admin_photo}}" width="100"></td>
                    <td>
                        <a class="btn btn-primary" href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a>||
                        <a class="btn btn-danger" href="{{url('/admin/delete/'.$v->admin_id)}}">删除</a>
                    </td>
                </tr>
            @php $i++ @endphp
            @endforeach
           
        </tbody>
    </table>
    {{ $data->appends($query)->links() }}
</body>
</html>