@extends('layout.admin.master')
@section('content_admin')
<section class="content">
<div class="row">       
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
            <form action="{{route('admin.products.post_product')}}" id="imageUploadForm" method="POST" enctype = "multipart/form-data">
            @csrf
       <div class="card-body" style="display: block;">

                 <div class="alert alert-info" style="display: none;"></div>

                <div class="form-group">
                    <label for="name">Tên Sản Phẩm</label>
                    <input type="text" id="name" class="form-control" name="name" />

                    <span class="error invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" id="price" class="form-control" name="price">
                          <span class="error invalid-feedback"></span> 
                </div> 

                <div class="form-group">
                    <div class="col-4" style="float: left;">
                        <label for="inputEstimatedBudget">Thương hiệu</label> <br>
                          @foreach($brands as $brand)
                            <input type="radio" id="brands_id_{{ $brand->id }}" name="brands_id" value="{{ $brand->id }}" />
                            <label for="brands_id_{{ $brand->id }}" 
                              >{{ $brand->name }}
                            </label><br />
                          @endforeach                 
                          <span class="error invalid-feedback brand_custom"></span>
                    </div>

                    <div class="col-4" style="float: left;">
                        <label for="inputEstimatedBudget">Loại</label> <br>
                        <select name="category_id" id="category_id" class="form-control">  
                        @foreach($arr as $list1) 
                        <optgroup label="{{$list1['name']}}">
                          @foreach($list1['childs'] as $list2)
                          <option value="{{$list2['id']}}">{{$list2['name']}}</option>                         
                          @endforeach
                        </optgroup>                 
                        @endforeach                                                       
                        </select>
                        <span class="error invalid-feedback"></span>
                    </div>

                    <div class="col-4" style="float: left;">
                    <div class="form-group">
                    <label for="price">số lượng</label>
                    <input type="text" id="number" class="form-control" name="number">
                          <span class="error invalid-feedback"></span> 
                   </div> 
                    </div>
                    
                </div>
        </div>
      </div>        
  </div>
 
   
        <div class="col-5">
            <div class="col-12">
              <div class="card-header">
                  <label>  Ảnh dại diện </label>
              </div>
              <div class="file-loading">
                    <input class="img" id="image" name="image" type="file">                                    
                </div>           
                
            </div>          
        </div>
     </div>
        <div class="row">
        <div class="col-12">
        <div class="card-header">
                  <label>  Albums </label>
        </div>
                  <div class="file-loading">
                      <input class="imgs"  id="images" name="images[]" type="file" multiple />
                  </div>
          </div>
        </div> 
        <!--------biến thể-------------------->
        <div class="row" >
          <div class="col-12">
             <div class="card-header">
                  <label>Biến thể</label>
              </div>
              <div class="col">
                    <label>Màu sắc</label>
                    <input type="text" name="color">                    
                    <label>size</label>
                    <input type="text" name="size">
                    <label>giá tiền</label>
                    <input type="text" name="prices">
                    <label>số lượng</label>
                    <input type="text" name="quanities">
                  
              </div>
            </div>
        </div> 
       <!---------text edior----------->
       <div class="row" >
          <div class="col-12">
             <div class="card-header">
                  <label>  mô tả dài</label>
                  <textarea name="des-longs" class="description"></textarea>
                 
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
                <input type="button" id="butSubmit" name="themmoi" value="Thêm mới" class="btn btn-success float-right">
              </div>
          </div>   
      </div>        
    </form>
    </section>

@stop

@section('footer_script')

<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script> 

    tinymce.init({
        selector: 'textarea.description', // Replace this CSS selector to match the placeholder element for TinyMCE
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
   	
        menubar: false,
        plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen code image',
                'insertdatetime media table paste code help wordcount'
            ],
      toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | link code image_upload|bullist numlist outdent indent |  image link' +
                'removeformat | help',
      image_title: true,
      automatic_uploads: true,
      images_upload_url: "{{ route('admin.products.upload_des_img') }}",
      file_picker_types: 'image',
      file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
          };
        };
        input.click();
    },
      content_css: '//www.tiny.cloud/css/codepen.min.css'
    });

  //var isAjax = false;
  var urlHinhDaiDien = '';
  var albums = [];

    
  $(function () {
 
    // initialize plugin with defaults  
    $('#butSubmit').click(function (e) {
    
      e.preventDefault(); 
  
      // Clear error message before submit
      $('.error').html('');
      $('.form-group').find('.is-invalid').removeClass('is-invalid');

      var form = $("#imageUploadForm");
      
      var url = $('#imageUploadForm').attr('action');
      //var data = $('#imageUploadForm').serialize();
      var data = new FormData(form[0]);
      
      //var formData = new FormData(this);
  
      // lay hinh dai dien tu upload
      if(urlHinhDaiDien !== '') { 
        data.append('hinh_dai_dien', urlHinhDaiDien);
      }

      // lay albums url from upload
      if(albums.length) {
        for(var i in albums) {
          data.append('albums[]', albums[i]);
        }
      }

      /*
      if(isAjax) {
          return false;
      }*/
        
        //isAjax = true;
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
              if(xxx.status === "ERR") {
              

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
              } else {

                var url = xxx.result.url;
                window.location.href = url;

              }

                //isAjax = false;
              //$('#butSubmit').addClass('btn-success');
              //$('#butSubmit').removeClass('btn-warning');
            }
        });

    });

    
    var $avatar = $("#image");
    $avatar.fileinput({
      
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        uploadUrl: "{{ route('admin.products.post_image') }}",
        uploadAsync: true,
        deleteUrl: "{{route('admin.products.del_image')}}",
        showUpload: false, // hide upload button
        overwriteInitial: false, // append files to initial preview
        minFileCount: 1,
        maxFileCount: 1,
        overwriteInitial: true,
        browseOnZoneClick: true,
        initialPreviewAsData: true,
    }).on("filebatchselected", function(event, files) {
        
        $avatar.fileinput("upload");
      

    }).on('fileuploaded', function(event, data) {

       urlHinhDaiDien = data.response.initialPreviewConfig[0].extra.url_hinh;
      

    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
      
    });

    // ...........nhieu hinh..............

     $albums = $("#images");
   
    $albums.fileinput({
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        uploadUrl: "{{ route('admin.products.post_images') }}",
        uploadAsync: true,
        deleteUrl: "{{route('admin.products.del_image')}}",
        showUpload: false, // hide upload button
        overwriteInitial: false, // append files to initial preview
        minFileCount: 1,
        maxFileCount: 12,
        browseOnZoneClick: true,
        initialPreviewAsData: true,
        
    }).on("filebatchselected", function(event, files) {
        
         $albums.fileinput("upload");
  

    }).on('fileuploaded', function(event, data) {
      
        albums.push(data.response.initialPreviewConfig[0].extra.url_hinh);
    

    }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {

     
    }).on('filedeleted', function (event, key, jqXHR, data) {
        var urlHinhXoa = data.url_hinh;

         var pos = albums.indexOf(urlHinhXoa);
         if(pos > -1) {
             albums.splice(pos, 1);
         }
   
    });

    // ......xóa..................
    
  });
  

</script>



@stop