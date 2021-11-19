
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
			<div class="table-responsive cart_info" id="table-list">
			<!-- ................................................... -->
			<table>
			<?php $value = session('cart'); ?>
			@if($value)
			<tr>
				<th>Name</th>
				<th>price</th>
				<th>hình ảnh</th>
				<th>số lượng</th>
				<th>thành tiền</th>
				
			</tr>
		
			<?php $totalMoney = 0; ?>
				@foreach($value as $item)
				<input type="hidden" id="idOrder" name="idOrder" value="{{$item['id']}}">
				<?php $result = $item['price'] * $item['quantity']; ?>
				<tr>
					<td>{{ $item['name'] }}</td>
					<td><?php echo number_format($item['price']); ?></td>
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
			<div id="btn-dis">
				<h3 class="pay-money"> 
						<span>Tổng tính: <?php echo number_format($totalMoney); ?></span>
				</h3>	
				<h1 style="font-size: 15px;">Tổng tiền khi giảm giá :<span id="allMoney"></span></h1>
				<input type="hidden" value="{{$totalMoney}}" id="provisional-money">
		
				<div class="form-group" style="width:50%;" id="box-check">
				@csrf
							<label for="exampleInputEmail1">Mã giảm giá</label> <span id="mess" style="color:Red;"></span>   
							<span id="mess" style="color:red"></span>
							<input type="text" class="form-control"  placeholder="" name="discount" id="inp-dis" >    
							<small id="" class="form-text text-muted">mã giảm giá gồm 6 số</small> 
							   
				</div>
				<button type="button" id="dis-btn" class="btn btn-info"  data-url="{{route('discount_checkcode')}}">kiểm tra</button>
			</div>		
			<!-- .................................................................. -->
			    </div>
            <hr>
			<form>   
            <div class="info-customer">
                <h3>Thông tin khách hàng</h3>
                         
                      <input type="radio" id="man" name="sex" value="0">
                      <label for="man">Anh</label>
                      <input type="radio" id="woman" name="sex" value="1">
                      <label for="woman">Chị</label><br>
                    <div class="form-group" style="width:50%;">
                        <label for="exampleInputEmail1">Họ và tên</label>
                        <input id="name" type="text" class="form-control"  placeholder="Nguyễn văn a" name="name">    
                                          
                    </div>
                    <div class="form-group" style="width:50%;">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input id="phone"type="text" class="form-control"  placeholder="09xxxxxx" name="phone">    
                                          
                    </div>
                     <input type="radio" id="1" name="deli" value="1">
                      <label for="1">Giao hàng tận nơi</label>
                      <input type="radio" id="2" name="deli" value="2">
                      <label for="2">Để tại cửa hàng</label><br>
                    <div class="form-group" style="width:50%;" id="form-gr1">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" id="address"class="form-control"  placeholder="Lê đại hành,..." name="address">    
                        <small id="" class="form-text text-muted">số nhà tên đường quận huyện</small>       
                    </div>                  
                    <button type="button" class="btn btn-success" data-url="{{route('order')}}" id="orderBtn">
						<a href="" style="color:white;">Đặt hàng</a> 
					</button>
				@endif
        	    </div>
			</div>
		</form>

</div><!--features_items-->
		
@stop
@section('script')
<script>



$(function() {
    $("#2").click(function(){
        $("#2").closest("form").find("#form-gr1").css("display","none")
    })
    $("#1").click(function(){
        $("#1").closest("form").find("#form-gr1").css("display","block")
    })
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
              
            }
        });
	
	});


	$("#dis-btn").click(function(){
		var btnCheck = $(this).closest('#btn-dis').find('#inp-dis').val() 
		
		var url1 = $(this).attr('data-url') 
		
		var provisionalMoney =  $(this).closest("#btn-dis").find('#provisional-money').val()
		
		var all = $(this).closest('#btn-dis').find('#allMoney')
		
		$.ajax({
			url: url1,         
            data: {
				disCheck: btnCheck
			},
            dataType: 'JSON',
            success: function (xxx) {
				if(xxx.status == 'OK'){
					if($(this).attr("disabled", true)){
					var res = xxx.result 
					
					var discount = (provisionalMoney * res)/100 
					var total = provisionalMoney-discount
					
					all.html('').append(total)
					$("#dis-btn").css("display","none")
					$("#box-check").css("display","none")
				  }
				
				}	
				if(xxx.status == "ERR"){
					var mess = xxx.mess
					$("#mess").html(mess)
				}
				
				//$(this).closest('#btn-dis').find('#allMoney').append(pay)
				
			},
			error: function(xxx) {
				console.log(xxx);
			}
             
        });
	})


	$("#orderBtn").click(function(e){
		
		e.preventDefault()
		var url1 = $(this).attr('data-url');
		var btnCheck = $('#inp-dis').val();
		var sex = $('input[name="sex"]:checked').val();	
		var name = $('#name').val() 
		
		var phone = $('#phone').val() 
		
		var address = $('#address').val()
		var Id = []
		$('input[id^="idOrder"]').each(function(){ Id.push(this.value); });		
		
		var deli = $('input[name="deli"]:checked').val();
	
		$.ajax({
			method: 'POST',
			url: url1,         
            data: {
				check:btnCheck,
				sex:sex,
				name:name,
				phone:phone,
				address:address,
				deli : deli,
				id : Id
			},
            dataType: 'JSON',
            success: function (xxx) {
				if(xxx.status == 'ok'){
					var url = xxx.result.url;
              		window.location.href = url;
				}
				//$(this).closest('#btn-dis').find('#allMoney').append(pay)
				
			}
             
        });
	})

});
 </script>
 @stop