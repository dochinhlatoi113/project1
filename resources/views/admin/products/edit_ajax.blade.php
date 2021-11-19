@extends('layout.admin.master')
@section('content_admin')
<section class="content">
<div class="row">      
  <div id="showMess"></div> 
  <div class="col-7">
    <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Sản phẩm mới</h3>
 
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form action="{{ route('admin.products.post_editAjax') }}" id="imageUploadForm" method="POST" enctype = "multipart/form-data">
            @csrf
       <div class="card-body" style="display: block;">

                 <div class="alert alert-info" style="display: none;"></div>

                <div class="form-group">
                    <label for="name">Tên Sản Phẩm</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{$products->name}}" />

                    <span class="error invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" id="price" class="form-control" name="price" value="{{$products->price}}">
                          <span class="error invalid-feedback"></span> 
                          
                </div> 
                
                <div class="form-group">
                    <div class="col-4" style="float: left;">
                        <label for="inputEstimatedBudget">Thương hiệu</label> <br>
                          @foreach($brands as $brand)
                            <input type="radio" id="brands_id_{{ $brand->id }}" name="brands_id" value="{{ $brand->id }}" @if($brand->id == $products->brands_id) checked @endif />
                          
                            <label for="brands_id_{{ $brand->id }}" 
                              >{{ $brand->name }}
                            </label><br />
                          @endforeach                  
                          <span class="error invalid-feedback brand_custom"></span>
                    </div>

                      

                    <div class="col-4" style="float: left;">
                        <label for="inputEstimatedBudget">Loại</label> <br>
                        <select name="category_id" id="category_id" class="form-control"> 
                        
                        @foreach($categories as $category)
                                                     
                            <option @if($category->id == $products->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>   
                        
                      
                        @endforeach                
                        </select>
                       
                        <span class="error invalid-feedback"></span>
                    </div>
                    
                </div>
                <div class="col-4" style="float: left;">
                    <div class="form-group">
                    <label for="price">số lượng</label>
                    <input type="text" id="number" class="form-control" name="number" value="{{$products->soluong}}"> 
                          <span class="error invalid-feedback"></span> 
                   </div> 
                  </div>
        </div>
      </div>        
  </div>
 
   
        <div class="col-5">
            <div class="col-12">
              <label>  Ảnh dại diện </label>
              <div class="file-loading">                               
                    <input class="img" id="image" name="image" type="file">                                    
              </div>           

            </div>          
        </div>
     </div>
        <div class="row">
            <div class="col-12"> 
                 <label> Album ảnh </label> 
               
                       <div class="file-loading" id="Alloading">
                          <input class="imgs"  id="images" name="images[]" type="file" multiple />
                      </div>    
                 
              
              </div>
        </div>  
          <!---------text edior----------->
       <div class="row" >
          <div class="col-12">
             <div class="card-header">
                  <label>  mô tả dài</label>
                  <textarea name="des-long" id="description" value="{{$products->des}}"></textarea>
              </div>
                    
            </div>
        </div> 
        <!-------------------> 
      </div> 
      
        <div  class="card-footer" >
        @if ($errors->has('img'))
          <span class="error invalid-feedback">{{ $errors->first('img') }}</span>
       @endif  
          <div class="row">
              <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
            
                <input type="text" name="hidenID" id="hidenID" value="{{$products->id}}">
              
                <input type="button" id="delImgAll" data-url="{{ route('admin.products.del_editAlbums', ['id' => $products->id]) }}" />

                <input type="button" id="butSubmit" 
                name="themmoi" value="Thêm mới" 
                class="btn btn-success float-right">
              </div>
          </div>   
      </div>  
    </form>
    </section>



@stop

@section('footer_script')
<script> 

  var isAjax = false;
  var urlHinhDaiDien = '';
  var albums = [];
  
  var initialEditPreview = {!! json_encode($initPreview) !!};
  var initialEditPreviewConfig = {!! json_encode($initPreviewConfig) !!};

  var AlbumPreview = {!! json_encode($AlPreview) !!};
  var AlbumConfig = {!! json_encode($AlConfig) !!};

  $(function () {
   
    // initialize plugin with defaults  
    $('#butSubmit').click(function (e) {
    
      e.preventDefault(); 

      // Clear error message before submit
      $('.error').html('');
      $('.form-group').find('.is-invalid').removeClass('is-invalid');

      var form = $("#imageUploadForm");

      var url = $('#imageUploadForm').attr('action');
 
      var data = new FormData(form[0]);
    
      if(urlHinhDaiDien !== '') { 
        data.append('hinh_dai_dien', urlHinhDaiDien);
      }

      // lay albums url from upload
      if(albums.length) {
        for(var i in albums) {
          data.append('albums[]', albums[i]);
        }
      }

      if(isAjax) {
          return false;
      }
        
        isAjax = true;
        $('#butSubmit').removeClass('btn-success');
        $('#butSubmit').addClass('btn-warning');
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            // submit post data and file
            contentType: false,
            cache : false,  // case when have upload file
            processData: false, // case when have upload file
            success: function (xxx) {
              if(xxx.status === "Ok") {
              console.log(111);return false;
                $("#showMess").html(xxx.mess)
                window.location = url
                var messages = xxx.messages;
                // messages = array("name" => 'This name is required', ...);
                for(var key in messages) {
                  var message = messages[key];

                  if(key === 'brands_id') {
                    
                      $('.brand_custom').html(message).show();

                  } else {
                      // key: name | price ,...
                      // message: this name is required
                      $('#'+key).addClass('is-invalid');

                      $('#'+key)
                        .closest('.form-group')
                        .find('.error')
                        .html(message);
                  }

                }
              } 

              isAjax = false;
              $('#butSubmit').addClass('btn-success');
              $('#butSubmit').removeClass('btn-warning');
            }
        });

    });
    



    var $avatar = $("#image");
   
     $avatar.fileinput({
     
         allowedFileExtensions: ['jpg', 'png', 'gif'],
         uploadUrl: "{{ route('admin.products.post_image') }}",
         uploadAsync: true,
         //deleteUrl: "{{route('admin.products.del_editAvatarImage',['id' => $products->id])}}",
         showUpload: false, // hide upload button
         overwriteInitial: true, // append files to initial preview
         minFileCount: 1,
         maxFileCount: 1,
         showRemove:false,
         browseOnZoneClick: true,
        initialPreviewAsData: true,
        initialPreview: initialEditPreview,
        initialPreviewConfig: initialEditPreviewConfig
        
    
    }).on("filebatchselected", function(event, files) {
        
        $avatar.fileinput("upload");


    }).on('fileuploaded', function(event, data) {

       urlHinhDaiDien = data.response.initialPreviewConfig[0].extra.url_hinh;
  

    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
      
     }).on('filedeleted', function(event, key, jqXHR, data) {
      var urlHinhXoa = data.url_hinh;

      var pos = albums.indexOf(urlHinhXoa);
      if(pos > -1) {
          albums.splice(pos, 1);
      }
    });

     $(".kv-file-remove").closest('#img').remove();

    
    // ...........nhieu hinh..............
    var $albums = $("#images");    

    if(AlbumConfig.length) {
        for(var i = 0; i < AlbumConfig.length; i ++) {
            albums.push(AlbumConfig[i].extra.url_hinh);
        }
    }


    $albums.fileinput({
      allowedFileExtensions: ['jpg', 'png', 'gif'],
        uploadUrl: "{{ route('admin.products.post_images', ['id' => $products->id]) }}",
        uploadAsync: true,
        showUpload: false, // hide upload button
        overwriteInitial: false, // append files to initial preview
        minFileCount: 1,
        maxFileCount: 12,
      
        browseOnZoneClick: true,
        initialPreviewAsData: true,
        initialPreview: AlbumPreview,
        initialPreviewConfig: AlbumConfig 
    }).on("filebatchselected", function(event, files) {
        
        $albums.fileinput("upload")


    }).on('fileuploaded', function(event, data) {

      albums.push(data.response.initialPreviewConfig[0].extra.url_hinh)
  

    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
        
    }).on('filedeleted', function(event, key, jqXHR, data) {
     
      var urlHinhXoa = data.url_hinh;

      var pos = albums.indexOf(urlHinhXoa);
      if(pos > -1) {
          albums.splice(pos, 1);
      }

    });
    // ......xóa..................

    $('.fileinput-remove-button').click(function (e) {

      
        var url = $('#delImgAll').attr('data-url');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {},
            dataType: 'JSON',
            
            success: function (xxx) {
                // TODO
                // $("#images").fileinput('reset');
            }
        });
        
    });
  
});
tinymce.init({
        selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
});
</script>



@stop