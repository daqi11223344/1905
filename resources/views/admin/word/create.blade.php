<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加文章管理</title>
</head>
<body>
@include('admin/public/head')
    <h1>添加文章</h1>
        <form action="{{url('/word/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
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
                <label class="col-sm-2 control-label" for="inputSuccess">文章名称</label>
                <div class="col-sm-10">
                    <input type="text" name="word_name" class="form-control" id="firstname" placeholder="请输入品牌名称">
                    <b style="color:red">@php echo $errors->first('word_name');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">所属分类</label>
                <select name="cate_id" id="">
							<option value="">请选择</option>
							@foreach ($cate as $k=>$v)
								<option value="{{$v->cate_id}}">{{$v->cate_name}}
                                </option>
							@endforeach
                        </select>
                        <b style="color:red">@php echo $errors->first('cate_id');@endphp</b>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">文章重要性</label>
                <label class="radio-inline">
                            <input type="radio" name="word_yy"  value="1" checked/>普通
                </label>
                <label class="radio-inline">
                            <input type="radio" name="word_yy"  value="0" />置顶
                </label>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">是否显示</label>
                <label class="radio-inline">
                            <input type="radio" name="is_show"  value="1" checked/>显示
                </label>
                <label class="radio-inline">
                            <input type="radio" name="is_show"  value="0" />不显示
                </label>
            </div>
            <div class="form-group has-warning">
                <label class="col-sm-2 control-label" for="inputSuccess">文章作者</label>
                <div class="col-sm-10">
                    <input type="text" name="word_man" class="form-control" id="firstname" placeholder="请输入品牌名称">
                </div>
            </div>
            <div class="form-group has-warning">
                <label class="col-sm-2 control-label" for="inputSuccess">作者email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="email" placeholder="请输入品牌名称">
                    <b style="color:red">@php echo $errors->first('email');@endphp</b>
                </div>
            </div>
            <div class="form-group has-warning">
                <label class="col-sm-2 control-label" for="inputSuccess">关键字</label>
                <div class="col-sm-10">
                    <input type="text" name="keyword" class="form-control" id="firstname" placeholder="请输入品牌名称">
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="word_desc" rows="3" placeholder="请进行分类描述"></textarea>
                </div>
            </div>
            <div class="form-group has-warning">
                <label for="lastname" class="col-sm-2 control-label">上传文件</label>
                <div class="col-sm-10">
                    <input type="file" name="word_file" class="form-control">
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
		$(this).next().remove();
		var obj = $(this);
		var word_name = $(this).val();
		var res1 = /^[a-zA-Z0-9_\u4e00-\u9fa5]{2,16}$/;
		if(!res1.test(word_name)){
			$(this).after('<b style="color:red;">文章标题不符合规范</b>');
			return;
		}
        

        $.ajax({
			method:"post",
			url:"{{url('/word/checkOnly')}}",
			data:{word_name:word_name}
		}).done(function(msg){
			if(msg>'0'){
				obj.after('<b style="color:red">文章标题已存在ajax</b>');
				nameflag=false;
			}
		});
    });


        $('#email').blur(function(){
            $(this).next().remove();
            var email = $(this).val();
            if(!email){
                $(this).after('<b style="color:red;">作者邮箱不能为空</b>');
                return;
            }
            var res2 = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
            if(!res2.test(email)){
                $(this).after('<b style="color:red;">作者邮箱不符合规范</b>');
                return;
		}
	});


        $('.btn-default').click(function(){
            // alert(123);
            var namesflag = urlflag = true;
		$('input[name="word_name"]').next().remove();
		var word_name = $('input[name="word_name"]').val();
		var res1 = /^[\u4e00-\u9fa5\w]{2,20}$/;
		if(!res1.test(word_name)){
			$('input[name="word_name"]').after('<b style="color:red;">文章名称不符合规范</b>');
			nameflag = false;
		}
		$('input[name="email"]').next().remove();
		var email = $('input[name="email"]').val();
		
		var res2 = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
		if(!res2.test(email)){
			$('input[name="email"]').after('<b style="color:red;">作者邮箱不符合规范</b>');
			urlflag = false;
		}

            
        // 唯一性验证
        $.ajax({
			method:"post",
			url:"{{url('/word/checkOnly')}}",
			data:{word_name:word_name}
		}).done(function(msg){
			if(msg>'0'){
				$('input[name="word_name"]').after('<b style="color:red">文章标题已存在ajax</b>');
				namesflag=false;
			}
		});

            if(namesflag==true&&urlflag==true){
                $('form').submit();
            }
        });
            
</script>
</html>