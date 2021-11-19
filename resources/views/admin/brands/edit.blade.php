@extends('layout.admin.master')
@section('content_admin')

<section class="content">
      <div class="row">       
        <div class="col">
          <div class="card card-secondary">
          @if (session('success'))
            <div class="alert alert-info">{{session('success')}}</div>
         @endif
         
         
       
            <div class="card-header">
              <h3 class="card-title">Chỉnh sửa danh mục sản phẩm </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form action="{{route('admin_brands_edit',['id'=>$brands->id])}}"  method="POST">
            @csrf
            <div class="card-body" style="display: block;">
           
                <div class="form-group">
                    <label for="inputEstimatedBudget">Tên thương hệu</label>
                    <input type="text" id="inputEstimatedBudget" class="form-control" name="name" required value="{{$brands->name}}">
                </div>
                @if ($errors->has('name'))
                      <div class="error invalid-feedback">{{ $errors->first('name') }}</div>
                 @endif   
                          
              </div>  
            @yield('code')
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="{{route('admin_brands')}}" class="btn btn-secondary">Cancel</a>
          <input type="submit" name="edit" value="sửa" class="btn btn-success float-right">
        </div>
      </div>
    </form>
    </section>
@stop

