@extends('layout.admin.master')
@section('content_admin')
<div class="card">
    <form action="{{ route('admin.brands_restore') }}" method="POST">
      @CSRF
              <div class="card-header">
                <h3 class="card-title">Condensed Full Width Table</h3>
                @if(count($brands))
                <button type="submit" id="butDelAll" class="btn btn-success">
                     Khôi phục               
                </button>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                 @foreach($brands as $data)
                    <tr>
                      <td>1.</td>
                      <td>{{$data->name}}</td>
                      <td>
                         <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                      <td> 
                          <div class="checkbox">
                                        <input type="checkbox" name="ids[]" value="{{$data->id}}" class="checkboxs">
                          </div>
                      </td>
                    </tr>
               @endforeach
                  </tbody>
                </table>
              </div>          
        </form>
              <!-- /.card-body -->
            </div>
            <div class="card-footer clearfix">
                  {{ $brands->links('admin.pagination.custom') }}
            </div>
            <!-- /.card -->
      
  </div>

@stop