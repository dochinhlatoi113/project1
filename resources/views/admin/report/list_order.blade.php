@extends('layout.admin.master')
@section('content_admin')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>                     
                      <th>Mã order</th>
                      <th>Tổng tiền</th>
                      <th>Tên khách hàng</th>                   
                      <th>Chi tiết</th>                    
                      <th>Ngày</th>
                      <th>Tình trạng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $item)
                    <tr>
                    
                      <td>{{$item['id']}}<td>
                      <td>
                      {{$item['name']}}
                      </td>
                      <td>
                         <span class="badge bg-danger">
                            <a href="{{route('admin.report.index_detail_order',['id' => $item['id']])}}"> xem chi tiết </a>

                         </span>
                      </td>                                   
                     <td>xx</td>
                      <td>
                         <select name="stt" id="stt">
                            <option value="Success">Thành công</option>
                            <option value="Err">Thất bại</option>
                        
                        </select>
                      </td>
                      <td>
                        <input type="text">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
               
              </div>
            </div>

@stop

@section('footer_script')
<script>


</script>


@stop

