@extends('layout.admin.master')
@section('content_admin')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                      @if (session('delete'))
                        <div class="alert alert-info">{{session('delete')}}</div>
                      @endif
                      <!-- Search form -->
                      <div class="row">
                     
                          <div class="col-10 md-form mt-0">
                            <form action="{{route('admin.brands')}}" method="GET">
                                <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="keywork">
                            </form>  
                          </div>
                   
                          <div class="col-2 form-check">
                              <input class="form-check-input" type="checkbox"  id="flexCheckDefault" name="flexCheckDefaultAll[]">
                              <label class="form-check-label" for="flexCheckDefault">
                                Chọn tất cả 
                              </label>
                          </div>
                      </div>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form id="formCate" action="{{ route('admin.brands_deleteall') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th class="sorting"> 
                                   <div class="row">  
                                      <div class="col-10">                                        
                                          Thương hiệu Sản phẩm
                                      </div>              
                                      <div class="col-2"> 
                                        <span><a href="{{route('admin.brands')}}?sort_by=ASC" style="color: black;">↑</a></span>
                                        <span><a href="{{route('admin.brands')}}?sort_by=DESC" style="color: black;">↓</span>
                                    </div>  
                                  </div>
                              </th>
                              <th>Slug</th>
                              <th>Tổng bài</th>
                              <th style="width: 20px"></th>
                              <th><span>Chọn <span> <br>
                          
                                  <button type="button" id="butDelAll" class="btn btn-warning btn-delete">xóa hết</button>
                                
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $index = 0; ?>
                              @foreach($lists as $list)
                            <tr>
                              <td>{{ $index }}</td>
                              <td>{{ $list->name }}</td>
                              <td>{{ $list->slug }}</td>
                              <td>
                                <div class="progress progress-xs">
                                  <div class="progress-bar progress-bar-danger" style="width:30%"></div>
                                </div>
                              </td>
                              <td>
                                <a href="{{route('admin.brands_edit', ['id' => $list->id] )}}" class="btn btn-warning">Sửa</a>

                                <a href="javascript:void(0)" data-url="{{ route('admin.brands_delete', ['id' => $list->id] ) }}" class="btn btn-danger butDelete">Xóa</a>
                              </td>
                              <td>
                                <div class="checkbox">
                                      <input type="checkbox" name="ids[]" value="{{ $list->id }}" class="checkboxs">
                                </div>
                              </td>
                            </tr>
                            <?php $index ++; ?>
                            @endforeach
                            </tbody>
                        </table>
                      </form>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{$lists->links('admin.pagination.custom') }}
                    
                      <button type="button" class="btn btn-success">
                          <a class="bnt-link__new" href="{{route('admin.brands_insert')}}"> Tạo mới </a>
                      </button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section> 
@stop

@section('footer_script')
<script>
 document.getElementById('flexCheckDefault').onclick = function() {
    var checkboxes = document.getElementsByName('ids[]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

$(function() {

 
  $('.butDelete').click(function () {
    var href = $(this).attr('data-url');
    if ( ! confirm('Bạn có chắc xóa không ?')) {
      return false;
    }
    window.location.href = href;
  });

  $('#butDelAll').click(function () {
    if ( ! confirm('Bạn có chắc xóa nhieu item khong ?')) {
      return false;
    }
    $('#formCate').submit();
  });
});
</script>
@stop

