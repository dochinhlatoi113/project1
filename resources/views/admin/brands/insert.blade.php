@extends('layout.admin.master')
@section('content_admin')
<section class="content">
      <div class="row">       
        <div class="col">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Danh mục thương hiệu mới</h3>
             
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form action="{{route('admin.brands_insert')}}"  method="POST">
            @csrf
            <div class="card-body" style="display: block;">
            @if (session('oke'))
                 <div class="alert alert-info">{{session('oke')}}</div>
               @endif
                <div class="form-group">
                    <label for="inputEstimatedBudget">Tên thương hiệu</label>
                    <input type="text" id="inputEstimatedBudget" class="form-control" name="name" required>
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
          <input type="submit" name="themmoi" value="Thêm mới" class="btn btn-success float-right">
        </div>
      </div>
    </form>
    </section>
@stop