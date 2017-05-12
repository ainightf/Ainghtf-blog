<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{URL::asset('style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{URL::asset('style/font/css/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">
			@if(session('msg'))
			<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="user_name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						{{--<img id="captcha_img" src='./app/org/code/captcha.php?r=eche ' alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">--}}
						<img src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
		</div>
	</div>
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script>
		$.ajaxSetup({
			headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
		});
		$('#btn').click(function () {
			var code = $.trim($('#code').val());
			if (code == ''){
				alert("请输入验证码");
				return false;
			}
			$.ajax({
				url:'',
				type:'post',
				dataType:'json',
				data:{
					code:code,
				},
				success:function (data) {
					alert(data.info);
				}
			})
		})
	</script>
</body>
</html>