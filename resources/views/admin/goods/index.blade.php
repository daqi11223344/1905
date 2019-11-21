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
        <input type="text" name="price" value="{{$query['price']??''}}" placeholder="请输入价格">
        <button>搜素</button>
    </form>
    

<a class="btn btn-default" href="{{url('/goods/create')}}">添加</a>
    <table class="table">
        <thead>
            <tr class="warning">
                <th>商品ID</th>
                <th>商品照片</th>
                <th>商品相册</th>
                <th>商品名称</th>
                <th>商品价格</th>
                <th>商品货号</th>
                <th>所属分类</th>
                <th>所属品牌</th>
                <th>是否上架</th>
                <th>是否热销</th>
                <th>是否新品</th>
                <th>商品描述</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($data as $v)
                <tr @if($i%2==0) class="success" @else class="danger" @endif>
                    <td>{{$v->goods_id}}</td>
                    <td><img class="img-circle" src="{{env('UPLOAD_URL')}}{{$v->goods_photo}}" width="100"></td>
                    <td>
                        @php
                            $str=explode('|',$v->goods_imgs);
                        @endphp
                    @foreach ($str as $val)
                        <img class="img-circle" src="{{env('UPLOAD_URL')}}{{$val}}" alt="" width="70">
                    @endforeach
                    </td>
                    <td>{{$v->goods_name}}</td>
                    <td>{{$v->goods_price}}</td>
                    <td>{{$v->goods_sn}}</td>
                    <td>
                        @php 
                            echo str_repeat('*',$v->level)
                        @endphp
                        {{$v->cate_name}}
                    </td>
                    <td>
                        {{$v->brand_name}}
                    </td>
                    <td>
                        @if ($v->is_on_sale==1)
                        {{'√'}}
                        @else
                        {{'×'}}
                        @endif
                    </td>
                    <td>
                        @if ($v->is_hot==1)
                        {{'√'}}
                        @else
                        {{'×'}}
                        @endif
                    </td>
                    <td>
                        @if ($v->is_new==1)
                        {{'√'}}
                        @else
                        {{'×'}}
                        @endif
                    </td>
                    <td>{{$v->goods_desc}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a>||
                        <a class="btn btn-danger" href="{{url('/goods/delete/'.$v->goods_id)}}">删除</a>
                    </td>
                </tr>
            @php $i++ @endphp
            @endforeach
          
        </tbody>
    </table>
    {{$data->appends($query)->links()}}
</body>
</html>