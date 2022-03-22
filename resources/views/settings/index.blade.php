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
                  <th>App Name </th>
                  <th>App Section</th>
                  <th>App Field</th>
                  <th>App Value 1</th>
                  <th>App Value 2</th>
                  <th>App Value 3</th>
                  <th>Action</th>
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