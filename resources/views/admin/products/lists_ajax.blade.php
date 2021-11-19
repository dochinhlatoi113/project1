
<!-- /.card-header -->
@if($keywork !== '' && $keywork !== NULL)
<p>Results: {{ $lists->total() }}</p>
@endif

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
                    
                </div>  
              </div>
          </th>
          <th>Giá</th>
          <th>Hình ảnh</th>
          <th style="width: 20px">Category</th>
          <th style="width: 20px">Thương hiệu</th>
          @if( !(count($lists)==0) )
          <th>
              <button type="button" id="butDelAll" class="btn btn-warning btn-delete">xóa hết</button>
            
          </th>
          @endif
          <th>
          @if( (count($lists) !== 0))
              <input type="checkbox" id="flexCheckDefault" name="flexCheckDefaults" />

              <label class="form-check-label" for="flexCheckDefault">
                Chọn tất cả 
              </label>
           @endif   
          </th>
        </tr>
      </thead>
      <tbody id="search-list">
        @if( (count($lists) == 0))
          <tr>
            <td colspan="8">Data not found</td>
          </tr>
        @else
          <?php $index = 0; ?>
          @foreach($lists as $list)
        <tr>
          <td>{{ $index }}</td>
          <td>{{ $list->name }}</td>
          <td>
            {!! $list->formatPrice() !!} 
          </td>
          <td>

            {!! $list->getImage() !!}

          </td>
          <td>
            {{ $list->category->name }}
          </td>
          <td>
            {{ $list->name }}
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
        @endif
        </tbody>
    </table>
  </form>
  
</div>

<div class="card-footer clearfix">
  {{$lists->links('admin.pagination.custom') }}

  <button type="button" class="btn btn-success">
      <a class="bnt-link__new" href="{{route('admin.products.insert')}}"> Tạo mới </a>
  </button>
</div>
                