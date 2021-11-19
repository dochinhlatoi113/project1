<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1> Welcome to {{ auth('web')->user()->name }}  </h1>
    <form action="{{route('user_update_info')}}" method="POST">
        @csrf
    <div class="form-group ">
        <label for="exampleInputEmail1">Tên của bạn</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{Auth::user()->name}}" name="name">        
    </div>   
    <div class="form-group ">
        <label for="exampleInputEmail1">Số diện thoại</label>
        <input type="test" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone" name="phone">
     
    </div>
  
    <div class="form-group ">
        <label for="exampleInputEmail1">Thay đổi Password</label> 
        <input type="text" name="pass">       
    </div>
     
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
    <button type="submit" class="btn btn-primary">
        <a style="color:white;" href="{{ route('logout') }}">Đăng xuất</a>
    </button>
    </form>
</div>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src=".{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
$(document).ready(function() {
	$('#datepick').datepicker()
});
</script>
</body>
</html>

