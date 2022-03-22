@extends('dashboardlayout')

@section('title', 'Truck')

@section('truck', 'active')

@section('content')

<style src="https:// //cdn.datatables.net/plug-ins/1.11.5/sorting/stringMonthYear.js" ></style>
<style src="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css"></style>

<style>
#truck-table .th {
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

          <h4 class="card-title">TRUCK</h4>
          <p class="category">These module is for truck functions. You can add, edit and truck trips here.</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="truck-table">
              <thead class="table-bordered">
                <th class="th">Name</th>
                <th class="th">Brand</th>
                <th class="th">Model</th>
                <th class="th">Plate No.</th>
                <th class="th">Ownwer</th>
                <th class="th">Status</th>
                <th class="th">Description</th>
                <th class="th" data-orderable="false">Action</th>
              </thead>
            </table>

              <!-- {{ $dataTable->table() }}   -->


            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  {{ $dataTable->scripts() }}
  <script src="{{asset('/js/globalFunctions.js')}}"></script>
@endsection

