@extends('layout.admin.master')
@section('content_admin')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>

              <p>Ma order: {{ $order->id }}</p>
              <p>Ten khach hang: {{ $order->name }}</p>
              <p>discount: {{ $order->discount }}</p>

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>                                      
                      <th>Tên sản phẩm</th>  
                      <th>Số lượng</th>                   
                      <th>Gia</th>  
                      <th>Thanh tien</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $tong = 0; ?>
                   @foreach($products as $product)
                    <tr>                    
                      <td>{{ $product->name }}</td>     
                      <td>{{ $product->quantity }}</td> 
                      <td>{{ $product->price }}</td> 
                      <td>{{$total = $product->quantity * $product->price }}</td>
                    </tr>
                   {{$tong = $tong + $total}}
                  @endforeach
                    <tr>
                      <td>total</td>
                      <td></td>
                      <td></td>
                      <td><?php echo $tong ?></td>
                    </tr>
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

