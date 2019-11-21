<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>货物管理展示页面</title>
</head>
<body>
    <h1 style="color:darkorange">货物管理展示页面</h1>
    <a href="{{url('/adds/create')}}"><p style="color:darkseagreen">添加货物</p></a>
        <table border="1px">
            <tr>
                <td>货物id</td>
                <td>货物名称</td>
                <td>货物图</td>
                <td>当前库存量</td>
                <td>入库时间</td>
                <td>操作</td>
            </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v->h_id}}</td>
                <td>{{$v->h_name}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->h_img}}" width="50"></td>
                <td>{{$v->h_num}}</td>
                <td>{{date('Y-m-d H:i:s',$v->h_time)}}</td>
                <td>
                <a href="{{url('/adds/delete/'.$v->h_id)}}">出库</a>
                </td>
            </tr>
        @endforeach
        </table>
</body>
</html>