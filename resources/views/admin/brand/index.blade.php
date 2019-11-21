<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>商品品牌列表</title>
</head>
<body>
@include('admin/public/head')
<h1>商品品牌列表</h1>

    <form action="">
        <input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入名称">
        <input type="text" name="desc" value="{{$query['desc']??''}}" placeholder="请输入留言">
        <button>搜素</button>
    </form>

<a class="btn btn-default" href="{{url('/brand/create')}}">添加</a>
    <table class="table">
        <thead>
            <tr class="warning">
                <th>品牌ID</th>
                <th>品牌LOGO</th>
                <th>品牌名称</th>
                <th>品牌网址</th>
                <th>品牌备注</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($data as $v)
                <tr @if($i%2==0) class="success" @else class="danger" @endif>
                    <td>{{$v->brand_id}}</td>
                    <td><img class="img-circle" src="{{env('UPLOAD_URL')}}{{$v->brand_LOGO}}" width="100"></td>
                    <td>{{$v->brand_name}}</td>
                    <td>{{$v->brand_url}}</td>
                    <td>{{$v->brand_desc}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{url('/brand/edit/'.$v->brand_id)}}">编辑</a>||
                        <a class="btn btn-danger" href="{{url('/brand/delete/'.$v->brand_id)}}">删除</a>
                    </td>
                </tr>
            @php $i++ @endphp
            @endforeach
           
        </tbody>
    </table>
    {{ $data->appends($query)->links() }}
</body>
</html>