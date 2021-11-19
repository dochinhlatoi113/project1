@extends('layout.admin.master')
@section('content_admin')

<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Bảng nhân viên</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="tên đăng nhập">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chức vụ</label>
                       <select id="staff">
                         <option value="manager">Quản lý</option>  
                         <option value="staff"> Nhân bán hàng</option>  
                         <option value="seo">Nhân viên seo</option>                       
                      </select>
                  </div>
                  <label for="exampleInputPassword1">Quyền</label>
                  <div class="permission" style="display: flex;">
                
                    <div class="post">
                      <div class="form-group">                      
                        <label for="exampleInputPassword1">Bài viết</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="1">
                          <label class="form-check-label" for="1">
                            Xóa bài viết
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="2">
                          <label class="form-check-label" for="2">
                            Thêm bài viết
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="3">
                          <label class="form-check-label" for="3">
                            sửa bài viêt
                          </label>
                        </div>
                      </div>
                    </div> 

                    <div class="product">
                      <div class="form-group">                      
                        <label for="exampleInputPassword1">Sản phẩm</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="4">
                          <label class="form-check-label" for="4">
                            Xóa sản phẩm
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="5">
                          <label class="form-check-label" for="5">
                           Thêm sản phẩm
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="6">
                          <label class="form-check-label" for="6">
                            sửa sản phẩm
                          </label>
                        </div>
                      </div>
                    </div> 
                    <div class="order">
                      <div class="form-group">                      
                        <label for="exampleInputPassword1">Đơn hàng</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="7">
                          <label class="form-check-label" for="7">
                              Xem đơn hàng
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="8">
                          <label class="form-check-label" for="8">
                            Sửa đơn hàng
                          </label>
                        </div>
                      
                      </div>
                    </div> 
                  </div>   

                 
                  </div>   
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
@stop

@section('footer_script')
<script>


</script>



@stop