
 

<div class="panel panel-default">

<h2>Category</h2>
	@if(isset($global_data['categories']))
		@foreach($global_data['categories'] as $item)
			
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordian" href="12">	
					@if(!($item['childs'] == NULL))			
					<span class="badge pull-right"><i class="fa fa-plus"></i></span>
					@endif				
					<span>{{$item['name']}} ({{$item['sum']}}) </span>
					@foreach($item['childs'] as $row)
						<div>--{{$row['name']}} @if(isset($row['total_product']) && $row['total_product'] > 0) ({{ $row['total_product'] }}) @endif</div>
					@endforeach	
				
				</a>
			</h4>
		</div>
			
		@endforeach
	@endif



</div>
							