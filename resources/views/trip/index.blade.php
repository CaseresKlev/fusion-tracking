@extends('dashboardlayout')

@section('title', 'Trips')

@section('trip', 'active')

@section('content')
<style>
#trip-table .th {
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


          <h4 class="card-title">TRIP</h4>
          <p class="category">These module is for TRIP functions. You can add, edit and delete trip here.</p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="row">
              <div class="col">
                <table>
                  <fieldset>
                  <tr>
                    Date Range Filter
                  </tr>
                  <tr>
                    <td><input type="text" id="startDate" name="startDate"></td>
                    <td><input type="text" id="endDate" name="endDate"></td>
                    <td><button id="filterDate" >Filter</button></td>
                    <td><a href="{{route('dashboard.trip')}}"><button id="filterDate" >Reload</button></a></td>
                  </tr>
                  </fieldset>
                </table>
              </div>
              <div class="col">
                <a href="{{  route('trip.create') }}" class="float-right"><button type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button></a>
              </div>
            </div>
          
                <table class="table table-bordered" id="trip-table">
                      <thead class="table-bordered">
                        <th class="th">Truck</th>
                        <th class="th">Truck_ID</th>
                        <th class="th" >Driver</th>
                        <th class="th">Ticket ID</th>
                        <th class="th">Source</th>
                        <th class="th">Destination</th>
                        <th class="th">Distance</th>
                        <th class="th" >Weight</th>
                        <th class="th">Rate</th>
                        <th class="th">Bill</th>
                        <th class="th">Date</th>
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

  // $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
  //       $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
  //           var minValue = $(this).val();
  //           minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
  //           minValue.setDate(minValue.getDate()+1);
  //           $("#to").datepicker( "option", "minDate", minValue );
  //       })


  $('#startDate').datepicker({format: 'yy-mm-dd'});
  $('#endDate').datepicker({format: 'yy-mm-dd'});

  drawTable("{{ route('trip.ajaxGetData') }}", '');
  

});

$('#filterDate').click(function(){
  //var startDate =  $('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  //var endDate =  $('#endDate').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  var startDate =  $('#startDate').val();
  var endDate =  $('#endDate').val();
 
  var link = generateDateRangeLink(startDate, endDate);
  drawTable("{{ route('dashboard.trip') }}", link);
  //$('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', startDate);
})

function drawTable(baselink, paramlink){


  var table = $('#trip-table').DataTable({
     // ajax: '{{ route("trip.ajaxGetData") }}',
     ajax: baselink + paramlink,
      "processing": true,
      "serverSide": true,
		  responsive: true,
      searching: true,
      columns: [
            // { data: 'truck_tooltip', render: function( data, type, row, meta){
            //   console.log(data);
            //   return data;
            //   //return '<a href=\"{{route("truck.show",1)}}\"><span data-toggle="tooltip" title="'+ data[0] +'">'+ data[1] +'</span></a>';
            //  // return '<a href="/'+ data[0] +'">'+ data[1] + '</a>';
            // } },
            {data: 'truck_tooltip', name: 'truck_tooltip'},

            //{ data: 'driver_id', name: 'driver_id' },
            { data: 'truck_id', name: 'truck_id'},
            { data: 'driver_tooltip', name: 'driver_tooltip'},
            { data: 'trip_ticket_id', name: 'trip_ticket_id' },
            { data: 'source', name: 'source' },
            { data: 'destination', name: 'destination' },
            { data: 'distance', name: 'distance' },
            { data: 'weigth', name: 'weigth' },
            { data: 'rate', name: 'rate' },
            { data: 'bill', name: 'bill' },
            { data: 'date', name: 'date' },
            //{ data: 'date', render: $.fn.dataTable.render.moment( 'X', 'Do MMM YY') },
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
                { "type": "html", targets: 0 },
                {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false
                }
                ],
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "bDestroy": true
  
    } );
}




</script>
<script src="{{asset('/js/globalFunctions.js')}}"></script>

@endsection