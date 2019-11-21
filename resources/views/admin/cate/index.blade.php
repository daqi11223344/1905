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
        <input type="text" name="name" value="{{$query['name']??''}}" placeholder="请输入名称">
        <button>搜素</button>
    </form>
    

<a class="btn btn-default" href="{{url('/cate/create')}}">添加</a>
    <table class="table">
        <thead>
            <tr class="warning">
                <th>分类ID</th>
                <th>分类名称</th>
                <th>顶级分类</th>
                <th>是否显示</th>
                <th>是否显示导航</th>
                <th>关键词</th>
                <th>描述</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($data as $v)
                <tr @if($i%2==0) class="success" @else class="danger" @endif>
                    <td>{{$v->cate_id}}</td>
                    <td>{{$v->cate_name}}</td>
                    <td>
                        @php 
                            echo str_repeat('*',$v->level)
                        @endphp
                        {{$v->cate_name}}
                    </td>
                    <td>
                        @if ($v->is_show==1)
                        {{'√'}}
                        @else
                        {{'×'}}
                        @endif
                    </td>
                    <td>
                        @if ($v->is_nav_show==1)
                        {{'√'}}
                        @else
                        {{'×'}}
                        @endif
                    </td>
                    <td>{{$v->keywords}}</td>
                    <td>{{$v->desc}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{url('/cate/edit/'.$v->cate_id)}}">编辑</a>||
                        <a class="btn btn-danger" href="{{url('/cate/delete/'.$v->cate_id)}}">删除</a>
                    </td>
                </tr>
            @php $i++ @endphp
            @endforeach
           
        </tbody>
    </table>
</body>
</html>