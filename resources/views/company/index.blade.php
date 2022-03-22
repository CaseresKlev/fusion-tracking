@extends('dashboardlayout')

@section('title', 'Company')

@section('company', 'active')

@section('content')

<style>
#company-table .th {
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


          <h4 class="card-title">COMPANY</h4>
          <p class="category">These module is for Company functions. You can add, edit and delete company here.</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <a href="{{  route('company.create') }}" class="float-right"><button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button></a>
                <table class="table table-bordered" id="company-table">
                      <thead class="table-bordered">
                        <th class="th" >Name</th>
                        <th class="th">Address</th>
                        <th class="th">Contact No.</th>
                        <th class="th">Email</th>
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

{{$dataTable->scripts()}}
<script src="{{asset('/js/globalFunctions.js')}}"></script>

@endsection