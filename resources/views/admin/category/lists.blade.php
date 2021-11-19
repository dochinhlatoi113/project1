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
                            <form action="{{route('admin.category.index')}}" 
                                method="GET">
                                <input class="form-control" type="text" placeholder="Tìm...." id="search" name="keywork" aria-label="Search" value="{{ $keywork }}"> 
                            </form>
                            <div id="search-list"></div>
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

                      <form id="formCate" 
                        action="{{ route('admin.category.del_all') }}" 
                        method="POST">
                        @csrf
                        <table class="table table-bordered table-hover dataTable" id="category">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th class="sorting"> 
                                   <div class="row">  
                                      <div class="col-10">                                        
                                          Tên Danh Mục Sản phẩm
                                      </div>              
                                      <div class="col-2"> 
                                        <span><a class="search" data-url="url"href="{{ route('admin.category.index', ['sort_by' => 'ASC', 'keywork' => $keywork]) }}" style="color: black;">↑</a></span>
                                        <span><a data-url="url" href="{{ route('admin.category.index', ['sort_by' => 'DESC', 'keywork' => $keywork]) }}" class="search"style="color: black;">↓</span>
                                    </div>  
                                  </div>
                              </th>
                             
                              <th>Tổng bài</th>
                              <th style="width: 20px"></th>
                              <th><span>Chọn <span> <br>
                          
                                  <button type="button" id="butDelAll" class="btn btn-success btn-delete">xóa hết</button>
                                
                              </th>
                            </tr>
                          </thead>
                          
                          <tbody id = "searchList">
                              <?php $index = 1; ?>
                              @foreach($arr as $list)
                              <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $list['name']}}</td>
                                <td>
                                  <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width:30%"></div>
                                  </div>
                                </td>
                                <td>
                                  <a href="{{route('admin.category.edit', ['id' =>$list['id']] )}}" class="btn btn-warning">Sửa</a>

                                  <a href="javascript:void(0)" data-url="{{ route('admin.category.delete', ['id' =>$list['id']] ) }}" class="btn btn-danger butDelete">Xóa</a>
                                </td>
                                <td>
                                  <div class="checkbox">
                                        <input type="checkbox" name="ids[]" value="{{$list['id'] }}" class="checkboxs">
                                  </div>
                                </td>
                              </tr>
                              
                              @if(isset($list['childs']))
                              @foreach($list['childs'] as $child)
                              <tr>
                                  <td>&nbsp;</td>                            
                                    
                                  <td><span style="margin-left: 10px;">{{ $child['name'] }}</span></td>
                                  <td>
                                      <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width:30%"></div>
                                      </div>
                                  </td>
                                  <td>
                                    <a href="{{route('admin.category.edit', ['id' =>$list['id']] )}}" class="btn btn-warning">Sửa</a>

                                    <a href="javascript:void(0)" data-url="{{ route('admin.category.delete', ['id' =>$list['id']] ) }}" class="btn btn-danger butDelete">Xóa</a>
                                  </td>
                                  <td>
                                    <div class="checkbox">
                                          <input type="checkbox" name="ids[]" value="{{$list['id'] }}" class="checkboxs">
                                    </div>
                                  </td>
                              </tr>
                              @endforeach
                              @endif
                              
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
                          <a class="bnt-link__new" href="{{route('admin.category.insert')}}"> Tạo mới </a>
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
    $('#formCate').submit()
  });
  



});
</script>


@stop

