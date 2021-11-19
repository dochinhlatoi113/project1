<aside class="main-sidebar sidebar-dark-primary elevation-4">
<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item ">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Sản phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">
            <li class="nav-item ">
            <a href="#" class="nav-link active"style="background-color:#dc3545; color:white">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>             
             
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category.insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm danh muc sản phẩm</p>
                </a>
              </li>             
             
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category.soft_delete')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thùng rác</p>
                </a>
              </li>             
             
            </ul>
          </li>        

          
        
   <!--------------------------------brands--------------------------->
   <li class="nav-item">
            <a href="#" class="nav-link active " style="background-color:#dc3545; color:white">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                 BRANDS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.brands')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách thương hiệu</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{route('admin.brands_insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Thương hiệu</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="{{route('admin.brands_soft_delete')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thùng rác</p>
                </a>
              </li>      
            </ul>
          </li>
          <!-- ...........products................... -->
          <li class="nav-item">
            <a href="#" class="nav-link active"style="background-color:#dc3545; color:white">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                 PRODUCTS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.products.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{route('admin.products.insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Sản Phẩm</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="{{route('admin.products.soft_delete')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thùng rác</p>
                </a>
              </li>      
            </ul>
          </li>
         <!-------------------------------------------------------------------------->
         <li class="nav-item">
            <a href="#" class="nav-link active"style="background-color:#dc3545; color:white">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                MÃ GIẢM 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{route('admin.index_insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm </p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="{{route('admin.discount_soft_delete')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thùng rác</p>
                </a>
              </li>      
            </ul>
          </li> 
        </ul>       
        <!-- .....................Kho hàng.......................................       -->
      
        <li class="nav-item">
            <a href="#" class="nav-link active " >
              <i class="nav-icon fas fa-tree"></i>
              <p>
                 Kho hàng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.brands')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách thương hiệu</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{route('admin.brands_insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm Thương hiệu</p>
                </a>
              </li>     
              <li class="nav-item">
                <a href="{{route('admin.brands_soft_delete')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thùng rác</p>
                </a>
              </li>      
            </ul>
          </li>


        <!-- ........................................................................... -->
        

        <!-- .....................Report.......................................       -->
      
        <li class="nav-item">
            <a href="#" class="nav-link active " >
              <i class="nav-icon fas fa-tree"></i>
              <p>
                 Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.report.list_order')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách đơn hàng</p>
                </a>
              </li>                  
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.report.index_report_order')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Báo cáo tổng quan</p>
                </a>
              </li>                  
            </ul>
          </li>


        <!-- ...........................Quản trị viên................................................ -->

        <li class="nav-item">
            <a href="#" class="nav-link active " >
              <i class="nav-icon fas fa-tree"></i>
              <p>
                  Quản trị viên
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.permission.permission.insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm thành viên</p>
                </a>
              </li>                  
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.permission.permission.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách thành viên</p>
                </a>
              </li>                  
            </ul>
          </li>



        <!----------------------------------------------------------------------------------->
         <!-- ...........................Bài viết................................................ -->

         <li class="nav-item">
            <a href="#" class="nav-link active " >
              <i class="nav-icon fas fa-tree"></i>
              <p>
                  Bài viết
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.post.post.insert')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bài viết</p>
                </a>
              </li>                  
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.post.post.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách bài viết</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{route('admin.post.post_soft_delete')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thùng rác</p>
                </a>
              </li>                     
            </ul>
          </li>



        <!----------------------------------------------------------------------------------->
      </ul>
    </nav>    




  </div>  
</aside>