
@extends('layout.admin.master')
@section('content_admin')
<section class="content">
      <div class="row">       
        <div class="col">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"></h3>
             
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	          </div>
            <form action="{{route('admin.index_insert')}}" id="form"  method="POST">
            @csrf
            <div class="card-body" style="display: block;">
            @if (session('oke'))
                 <div class="alert alert-info">{{session('oke')}}</div>
               @endif
                <div class="form-group">
                    <label for="inputEstimatedBudget">Tên mã</label>
                    <input type="text" id="name" class="form-control" name="name" >
                    <label for="inputEstimatedBudget">% tiền giảm</label>
                    <input type="text" id="dis_money" class="form-control" name="dis_money" >
                    <label for="inputEstimatedBudget">số lần sử dụng</label>
                    <input type="text" id="max_time" class="form-control" name="max_time" >
                    
                </div>
                @if ($errors->has('name'))
                      <div class="error invalid-feedback">{{ $errors->first('name') }}</div>
                 @endif  
                </div>  
         
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input id="butsave" type="submit" name="insert" value="Thêm" class="btn btn-success float-right">
        </div>
      </div>
    </form>
    </section>
@stop


@section('footer_script')
<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var name = $('#name').val();
    var dis_money = $('#dis_money').val();
    var max_time = $("#max_time").val();
		if(name!=""){
			$.ajax({
				url: "{{route('admin.index_insert')}}",
				type: "POST",
				data: {
					name: name,
          dis_money:dis_money,	
          max_time:max_time							
				},
				cache:false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult); console.log(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#form').find('input:text').val('');	
            $("#success").show();
						$('#success').html('Data added successfully !'); 						
					  }									
					}
				
					
				
			});
		}
	
	});
});
</script>


@stop