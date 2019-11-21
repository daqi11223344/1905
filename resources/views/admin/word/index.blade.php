<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>文章列表</title>
</head>
<body>
@include('admin/public/head')
<h1>文章列表</h1>
<form action="">
        <input type="text" name="name" value="{{$query['name']??''}}" placeholder="请输入名称">
        <select name="cate_id" id="">
							<option value="">请选择</option>
							@foreach ($cate as $k=>$v)
								<option value="{{$v->cate_id}}" >{{$v->cate_name}}</option>
							@endforeach
						</select>
        <button>搜素</button>
    </form>

<a class="btn btn-default" href="{{url('/word/create')}}">添加</a>
    <table class="table">
        <thead>
            <tr class="warning">
                <th>文章id</th>
                <th>文章标题</th>
                <th>文章分类</th>
                <th>文章重要性</th>
                <th>是否显示</th>
                <th>添加日期</th>
                <th>文章相册</th>
                <th>状态</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($data as $v)
                <tr @if($i%2==0) class="success" @else class="danger" @endif>
                    <td>{{$v->word_id}}</td>
                    <td>{{$v->word_name}}</td>
                    <td>{{$v->cate_name}}</td>
                    <td>
                        @if ($v->word_yy==1)
                        {{'普通'}}
                        @else
                        {{'置顶'}}
                        @endif
                    </td>
                    <td>
                        @if ($v->is_show==1)
                        {{'√'}}
                        @else
                        {{'×'}}
                        @endif
                    </td>
                    <td>{{date('Y-m-d H:i:s',$v->word_time)}}</td>
                    <td><img class="img-circle" src="{{env('UPLOAD_URL')}}{{$v->word_file}}" width="100"></td>
                    <td>
                        <a class="btn btn-primary" href="{{url('/word/edit/'.$v->word_id)}}">编辑</a>||
                        <a class="btn btn-danger" href="javascript:void(0)" word_id="{{$v->word_id}}">删除</a>
                    </td>
                </tr>
            @php $i++ @endphp
            @endforeach
           
        </tbody>
    </table>
    {{$data->appends($query)->links()}}
</body>

<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ajax删除
	 $(document).on('click','.btn-danger',function(){
        //  alert(123);
	 	var word_id = $(this).attr('word_id');
	 	// alert(word_id);return;
	 	if(confirm('确认删除此记录吗？')){
	 		$.post("{{url('word/delete')}}",{word_id:word_id},function(data){
	 			if(data.code == '00000'){
	 				// alert(data.data);
	 				window.location.reload();
	 			}
	 		},'json');
	 	}
	 });

</script>

</html>