
@extends('layout.front.master')
@section('content')


<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Features Items</h2>
	@foreach($products as $data)
	<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
					<form action="" method="POST">
					<div class="productinfo text-center">
						@if(isset($data->img))
						<a href= "{{route('detail',['id'=>$data->id])}}"><img class="img" src="{{asset($data->img)}}" alt="" style="width:250px; height:250px;" /></a>
						@else
						<a href= "{{route('detail',['id'=>$data->id])}}">
						<img  src="https://png.pngtree.com/png-clipart/20190925/original/pngtree-no-avatar-vector-isolated-on-white-background-png-image_4979074.jpg"></a>
						@endif
						
							<h2>{!! $data->formatPrice() !!}</h2>
							<p class="title" title="{{$data->name}}">{{$data->name}}</p>
							<a href="{{route('cart_add')}}" 
								class="btn btn-default add-to-cart"
								data-id= "{{$data->id}}"
								data-url="{{ route('cart_add') }}">
								<i class="fa fa-shopping-cart"></i><span> </span>Add to cart
							</a>
						
					</div>
					<!--<div class="product-overlay">
						<div class="overlay-content">
							<h2 style="color:white !important;">{!! $data->formatPrice() !!}</h2>
							<p></p>
							<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
					</div>-->
			</div>
				</form>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
					<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
				</ul>
			</div>
		</div>
	</div>


	@endforeach	
	

</div><!--features_items-->

<div class="card-footer clearfix">
  		{{$products->links('admin.pagination.custom') }}
	</div>
@stop
@section('script')
<script>

$(function() {
	
	$('.add-to-cart').click(function (e) {
	
		e.preventDefault();
		var url = $(this).attr('data-url');
		var productId = $(this).attr('data-id');
		
		$.ajax({
            url: url,
            type: 'POST',
            data: {
				productId: productId
			},
            dataType: 'JSON',
            success: function (xxx) {
            	 $('.cartNumber').html(xxx.result.sum);
				
            }
        });
		
	});
    
});
 </script>
 @stop