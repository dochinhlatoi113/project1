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
                      <form id="formCate" action="{{ route('admin.products.delete_all') }}" method="POST">
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
                                        <span><a href="{{ route('admin.products.index', ['sort_by' => 'ASC', 'keywork' => $keywork]) }}" style="color: black;">↑</a></span>
                                        <span><a href="{{ route('admin.products.index', ['sort_by' => 'DESC', 'keywork' => $keywork]) }}" style="color: black;">↓</span>
                                    </div>  
                                  </div>
                              </th>
                              <th>Giá</th>
                              <th>Hình ảnh</th>
                              <th style="width: 20px">Category</th>
                              <th style="width: 20px">Thương hiệu</th>
                              <th><span>Chọn <span> <br>
                          
                                  <button type="button" id="butDelAll" class="btn btn-warning btn-delete">xóa hết</button>
                                
                              </th>
                            </tr>
                          </thead>
                          <tbody id="search-list">
                              <?php $index = 0; ?>
                              @foreach($lists as $list)
                            <tr>
                              <td>{{ $index }}</td>
                              <td>{{ $list->name }}</td>
                              <td>
                                {!! $list->formatPrice() !!} 
                              </td>
                              <td>
                                <?php // check hinh co ton tai hay khong ?>
                                <img src="{{asset($list->img)}} " style="width: 100px">
                                <?php //  ?>
                              </td>
                              <td>
                                {{ $list->category->name }}
                              </td>
                              <td>
                                {{ $list->brand->name }}
                              </td>
                              <td>
                                <a href="{{route('admin.products.edit', ['id' => $list->id] )}}" class="btn btn-warning">Sửa</a>

                                <a href="javascript:void(0)" data-url="{{ route('admin.products.delete', ['id' => $list->id] ) }}" class="btn btn-danger butDelete">Xóa</a>
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
                    <div id="table_data">
                       @include('admin.pagination.ajax')
                    </div>
                    <div class="card-footer clearfix">
                      {{$lists->links('admin.pagination.custom') }}
                    
                      <button type="button" class="btn btn-success">
                          <a class="bnt-link__new" href="{{route('admin.products.insert')}}"> Tạo mới </a>
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
  var listUrlAjax = '{{ route("admin.product.index") }}';
 document.getElementById('flexCheckDefault').onclick = function() {
    var checkboxes = document.getElementsByName('ids[]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

$(function() {

  fncLoadList();


 
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

function fncLoadList() {
    $.ajax({
        url: url,
        type: 'GET',
        data: {},
        dataType: 'JSON',
        success: function (result) {
            console.log(result);
        }
    });
}

</script>
@stop

