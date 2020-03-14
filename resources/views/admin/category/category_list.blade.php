@extends('admin.layouts.app')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Manage Categories</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Manage Categories</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>SL</th>
            <th>Category Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          @foreach($data['all_records'] as $row)
          <tr>
              <td>{{ $i }}</td>
              <td> 
                 @if($row->level == 0) <b>  @endif 
                 @if($row->level == 1) &nbsp; - @endif   
                 @if($row->level == 2) &nbsp; &nbsp; - - @endif     
                 @if($row->level == 3) &nbsp; &nbsp; &nbsp; - - - @endif       
                 @if($row->level == 4) &nbsp; &nbsp; &nbsp; &nbsp; - - - - @endif       
                 @if($row->level == 5) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  - - - - - @endif       
                 @if($row->level > 5)  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - - - @endif
                 
                 {{ $row->category_name }}

                 @if($row->level == 0) </b>  @endif 
              </td> 
                
              <td>
                <button onclick="window.location='{{ url('/')}}/admin/category/edit/{{$row->category_row_id}}'" class="btn btn-warning">Edit</button>
                
                <button deleteID="{{$row->category_row_id}}"  class="btn btn-danger deleteLink">Delete</button>

              </td>
          </tr>
          <?php $i++; ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('page_level_js')
<script type="text/javascript"> 
 $('.deleteLink').click( function() {
  if( confirm('Are you sure to Delete ? ') )
  {
   var deleteID = $(this).attr('deleteID');   
    window.location.href = "{{ url('/')}}/admin/category/deleteRecord/" + deleteID;    
  }
        
 });
 
 </script> 
@endsection

     