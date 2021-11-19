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
                  
                      <form method = "GET" action="{{route('admin.products.index_ajax')}}">
                          @csrf
                            <div class="row"> 
                                            
                                <div class="col-10 md-form mt-0">                            
                                  <input class="form-control" type="text" id="search" placeholder="Search" aria-label="Search" name="keywork"  >                                
                                </div>
                                <div class="col-2">
                                    <input type="submit" id="inputsearch" /> 
                                </div>                        
                            </div>  
                        </form>
                    </div>

                    <p style="display: none;">Result1: <span id="result_search"></span></p>
                   

                    <div id="loadList">
                      
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
  
var listUrlAjax = '{{ route("admin.products.index_ajax") }}';
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(document)

  .ajaxStart(function () {
        $loading.show();
    })
  .ajaxStop(function () {
      $loading.hide();
  });

$(function() {

  fncLoadList();

  $('#loadList').delegate('#flexCheckDefault', 'click', function () {
      var checked = $(this).prop('checked');
      $('.checkboxs').each(function () {
          $(this).prop('checked', checked);
      });
  });

  $('#loadList').delegate('.butDelete', 'click', function () {
      var href = $(this).attr('data-url');
      if ( ! confirm('Bạn có chắc xóa không ?')) {
          return false;
      }
      window.location.href = href;
  });

  $('#loadList').delegate('#butDelAll', 'click', function () {
      if ( ! confirm('Bạn có chắc xóa nhieu item khong ?')) {
          return false;
      }
      $('#formCate').submit();
  });

  $('#loadList').delegate('.page-link', 'click', function (e) {
      e.preventDefault();
      
      listUrlAjax = $(this).attr('href');
      $(this).attr('href', 'javascript:void(0)')

      fncLoadList();

  });

  $('#inputsearch').click(function (e) {
        e.preventDefault();

        fncLoadList();
  });



  

});

function fncLoadList() {
  var valSearch = $("#search").val();
    $.ajax({
        url: listUrlAjax,       
        type: 'GET',
        data: {keywork : valSearch},
        dataType: 'JSON',
        success: function (data) {       
         
            $('#loadList').html(data.result.html);

            if(data.result.keywork !== '' && data.result.keywork !== null) {
                $('#result_search').html(data.result.result_total);
                $('#result_search').closest('p').show();
            }

        }   
    })
}
</script>
@stop

