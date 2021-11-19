
<h2>Brands</h2>
<div class="brands-name">
	<ul class="nav nav-pills nav-stacked">
	@foreach($global_data['categories'] as $item)
		<li>{{$item['name']}}</li>
	@endforeach
	</ul>
</div>
					