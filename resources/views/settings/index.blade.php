@extends('dashboardlayout')

@section('title', 'Settings')

@section('settings', 'active')

@section('content')

<style>
#setting-table .th {
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

          <h4 class="card-title">SETTINGS</h4>
          <p class="category">THESE MODULE IS FOR ADMIN SETTINGS ONLY!</p>
        </div>
        <div class="card-body">
        <a href="{{  route('settings.create') }}" class="float-right"><button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button></a>
          <div class="table-responsive">
              <table class="table table-bordered" id="setting-table">
                <thead class="table-bordered">
                  <th class="th">App Name </th>
                  <th class="th">App Section</th>
                  <th class="th">App Field</th>
                  <th class="th">Value 1</th>
                  <th class="th">Value 2</th>
                  <th class="th">Value 3</th>
                  <th class="th">Added By</th>
                  <th class="th">Description</th>
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

@section("scripts")

<script>

$( document ).ready(function() {
  $('#setting-table').dataTable({
      ajax: '{{ route("settings.ajaxGetData") }}',
      "processing": true,
      "serverSide": true,
		  responsive: true,
      columns: [
            { data: 'app_name', name: 'app_name' },
            { data: 'app_section', name: 'app_section' },
            { data: 'app_field', name: 'app_field' },
            { data: 'app_value_1', name: 'app_value_1' },
            { data: 'app_value_2', name: 'app_value_2' },
            { data: 'app_value_3', name: 'app_value_3' },
            { data: 'added_by', name: 'added_by' },
            { data: 'app_setting_description', name: 'app_setting_description' },
            { 
              data: 'action', 
              name: "action", 
              orderable: false, 
              searchable: false
            }
        ],
		  columnDefs: [
		            { responsivePriority: 1, targets: 0 },
		            { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 2 },
		            { responsivePriority: 4, targets: 3 },
                { responsivePriority: 5, targets: 6 },
		        ],
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});


</script>
<script src="{{asset('/js/globalFunctions.js')}}"></script>

@endsection