

<div class="card">
              <div class="card-header">
                <h3 class="card-title">New Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>                     
                      <th>Mã order</th>
                      <th>Tên khách hàng</th>
                      <th>Tên sản phẩm</th>
                      <th>Số lượng mua</th>
                      <th>Thành tiền</th>
                      <th>Mã giảm</th>
                      <th>Phần trăm giảm</th>
                      <th>Tổng tiền</th>
                      <th>Ngày</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($list as $item)
                    <tr>
                    
                      <td>{{$item['order_id']}}<td>
                      <td>
                      {{$item['name']}}
                      </td>
                      <td>
                         <span class="badge bg-danger">xx</span>
                      </td>
                      <td>
                       xxx
                      </td>
                      <td>
                       xxx
                      </td>
                      <td>
                       xxx
                      </td>
                      <td>
                       xxx
                      </td>
                      <td>
                       xxx
                      </td>
                
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
        </div>

