@extends('dashboardlayout')

@section('title', 'Driver')

@section('driver', 'active')

@section('content')
<style src="https:// //cdn.datatables.net/plug-ins/1.11.5/sorting/stringMonthYear.js" ></style>
<!-- <style src="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"></style> -->
<style>
#drivers-table .th {
    border-bottom-width: 1px;
    font-size: 1rem !important;
    font-weight: bold;
    color: red;
}

.icons-option a{
  padding: 5px;
}
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
   
   
    

      <div class="card">
        <div class="card-header">

        @include('include.ConfirmationMessages')

          <h4 class="card-title">DRIVER</h4>
          <p class="category">These module is for Driver functions. You can add, edit and delete driver here.</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
                    <table class="table table-bordered" id="drivers-table">
                      <thead class="table-bordered">
                        <th class="th" >Firstname</th>
                        <th class="th">Middlename</th>
                        <th class="th">Lastname</th>
                        <th class="th">Position</th>
                        <th class="th">Trip Status</th>
                        <th class="th">Updated at</th>
                        <th class="th" data-orderable="false">Action</th>
                      </thead>
                    </table>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>

$(function() {
    $('#drivers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("dashboard.driver.api.getdata") }}',
        columns: [
            { data: 'firstname', name: 'firstname' },
            { data: 'middlename', name: 'middlename' },
            { data: 'lastname', name: 'lastname' },
            { data: 'position', name: 'position' },
            { data: 'trip_status', name: 'trip_status' },
            { data: 'updated_at', name: 'updated_at' },
            { 
              data: 'action', 
              name: "action", 
              orderable: false, 
              searchable: false
            }
            // {"defaultContent": 
            //   '<div class="row">'
            //   +'<div class="col icons-option" >'
            //   +'<a href="{{ route("sample.show", [1]) }}"><i class="fa-solid fa-eye"></i></a>' 
            //   + '<a href="#"><i class="fas fa-edit"></i></a>'
            //   + '<a href="#"><i class="fa-solid fa-trash-can"></i></a>'
            //   +'</div>'
            //   +'</div>'}
        ],
        columnDefs: [
        { "orderable": false, "targets": [7] },
        ],
        columnDefs: [
          { type: 'stringMonthYear', targets: 5 }
        ],
         dom: 'Bfrtip',
         buttons: [
             'copy', 'csv', 'excel', 'pdf', 'print'
         ]
    });
});



//alert("Trigger on Driver Script");
</script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/js/globalFunctions.js')}}"></script>
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> -->
@endsection