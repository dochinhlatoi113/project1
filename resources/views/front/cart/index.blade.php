
@extends('layout.front.master')
@section('content')
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
	width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<div class="features_items"><!--features_items-->
<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<!-- ................................................... -->
			<table>
			<tr>
				<th>Name</th>
				<th>price</th>
				<th>hình ảnh</th>
				<th>số lượng</th>
				<th>thành tiền</th>
				
			</tr>
			@if($value = session('cart'))

				<?php $totalMoney = 0; ?>
				@foreach($value as $item)
				<?php $result = $item['price'] * $item['quantity']; ?>
				<tr>
					<td>{{ $item['name'] }}</td>
					<td><?php echo number_format($item['price']);?></td>
					<td></td>
					<td>{{$item['quantity']}}</td>
					<td><?php echo number_format($result);?></td>
					<td>
						<button type="button" class="btn btn-danger del" name="del"value="{{$item['id']}}">
							<a href="{{route('cart_list_delete')}}" class="del-btn" data-id= "{{$item['id']}}" data-url="{{ route('cart_list_delete') }}">
							xóa</a>
						</button>
					</td>
				</tr>
				<?php $totalMoney += $result;  ?>
				@endforeach
			
			</table>
			<hr>
			<div class="total">
				<span>Tạm tính: <?php echo number_format($totalMoney); ?></span>
			</div>
			
			<button type="button" class="btn btn-primary" style="background-color: #007bff;" data-toggle="modal" data-target="#exampleModal">
				<a href="{{route('pay')}}" style="color:white;">Tiến hành thanh toán</a>
			</button>
			@endif
			<!-- .................................................................. -->
			</div>
		</div>


</div><!--features_items-->
		
@stop
@section('script')
<script>

$(function() {
	$( ".del-btn" ).click(function(e) {
		e.preventDefault();
		//console.log(11);return false
		var url = $(this).attr('data-url');
		var proId = $(this).attr('data-id');
		//console.log(proId);return false;
		$.ajax({
            url: url,         
            data: {
				proId: proId
			},
            dataType: 'JSON',
            success: function (xxx) {
				if(xxx.status == 'OK'){
					window.location.href = xxx.result.url
				}
            }
        });
	
	});


});
 </script>
 @stop