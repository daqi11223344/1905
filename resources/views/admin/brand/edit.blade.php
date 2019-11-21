<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title>修改商品品牌</title>
</head>
<body>
@include('admin/public/head')
    <h1>修改商品品牌</h1>
        <form action="{{url('/brand/update/'.$data->brand_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                <label class="col-sm-2 control-label" for="inputSuccess">品牌名称</label>
                <div class="col-sm-10">
                    <input type="text" name="brand_name" value="{{$data->brand_name}}" class="form-control" id="firstname" placeholder="请输入品牌名称">
                    <b style="color:red">@php echo $errors->first('brand_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
                <div class="col-sm-10">
                    <input type="text" name="brand_url" value="{{$data->brand_url}}" class="form-control" id="lastname" placeholder="请输入品牌网址">
                    <b style="color:red">@php echo $errors->first('brand_url');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
                <div class="col-sm-10">
                <img class="img-circle" src="{{env('UPLOAD_URL')}}{{$data->brand_LOGO}}" width="100">
                    <input type="file" name="brand_LOGO" class="form-control" id="lastname">
                </div>
            </div>
            <div class="form-group has-error">
                <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="brand_desc" value="{{$data->brand_desc}}" rows="3" placeholder="请进行品牌描述"></textarea>
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