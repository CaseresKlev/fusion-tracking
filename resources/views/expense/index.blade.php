@if($actionMethod == 'view')
<style>
#expense-table .th {
    border-bottom-width: 1px;
    font-size: 1rem !important;
    font-weight: bold;
    color: red;
}

.icons-option a{
  padding: 5px;
}
</style>


<!-- <div class="panel-header panel-header-sm">
</div> -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">

         @include('include.ConfirmationMessages')


          <h4 class="card-title">EXPENSES</h4>
          <p class="category text-primary"><strong>These expenses are binds to the TRUCK ID and TRIP ID.</strong></p>
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
                    <td><button id="resetFilterDate" >Reload</button></td>
                  </tr>
                  </fieldset>
                </table>
              </div>
              <div class="col">
                <span class="float-right"><button type="button" id="btnModalShow" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button></span>
                
              </div>
            </div>
            <div id="ajaxMsgHolder"></div>
                <table class="table table-bordered display " id="expense-table" width="100%">
                      <thead class="table-bordered">
                        <th class="th" data-priority="1">Trip ID</th>
                        <th class="th" data-priority="2">Truck</th>
                        <th class="th" data-priority="3">Company</th>
                        <th class="th" data-priority="4">Driver</th>
                        <th class="th" data-priority="6">Ref.# / PPIS #</th>
                        <th class="th">Source</th>
                        <th class="th">destination</th>
                        <th class="th">Item</th>
                        <th class="th">Quantity</th>
                        <th class="th">Accumulated Total</th>
                        <th class="th">Entry By</th>
                        <th class="th">Date</th>
                        <th class="th" data-orderable="false" data-priority="5">Action</th>
                      </thead>
                </table>
                
          </div>
          </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Add Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('expense.create_update')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary " id="modalBtnSubmit" onclick="modalBtnClick('store')">Save</button>
        <button type="button" class="btn btn-primary " id="modalBtnUpdate" onclick="modalBtnUpdateClick('update')">Update</button>
      </div>
    </div>
  </div>
</div>

@section("scripts")

<script>


$( document ).ready(function() {
  var editID = 0;

  // $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
  //       $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
  //           var minValue = $(this).val();
  //           minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
  //           minValue.setDate(minValue.getDate()+1);
  //           $("#to").datepicker( "option", "minDate", minValue );
  //       })


  $('#startDate').datepicker({format: 'yy-mm-dd'});
  $('#endDate').datepicker({format: 'yy-mm-dd'});

  //drawTable("{{ route('trip.ajaxGetData') }}", '');
  loadExpenseData();


  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })

  $('#form-expense').on('submit', function(e){
        e.preventDefault();
        alert("dawdw");
        //var len = $('#username').val().length;
        // if (len < 6 && len > 1) {
        //     this.submit();
        // }
    });
  
  $('#form-expense').validate({ // initialize the plugin
          rules: {
            company_id: {
                  required: true,
                  
              },
              truck_id: {
                  required: true,
              },
              item: {
                  required: true,
              },
              quantity: {
                  required: true,
              },
              accumulated_total: {
                  required: true,
              },
              date: {
                  required: true,
              }
          },
          messages: {
              company_id: "Company is required",
              truck_id: "Truck is required",
              item: "Item is required",
              quantity: "Quantity is required",
              accumulated_total: "Accumulated Total is required",
              date: "Date is required",
          },
              
  });

});

$("#btnModalShow").click(function(){
  $("#refID").val("");
  $("#item").val("");
  $("#quantity").val("");
  $("#accumulated_total").val("");
  $("#entry_by").val("");
  $("#dateInput").val("");
  $("#modalTitle").html("Add Expense");
  $("#modalBtnSubmit").show();
  $("#modalBtnUpdate").hide();
  $("#expenseModal").modal("show");
})

$("#btnModalHide").click(function(){
  $("#expenseModal").modal("hide");
})

$("#resetFilterDate").click(function(){
  resetFilterTable();
  loadExpenseData();
})

$('#filterDate').click(function(){
  //var startDate =  $('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  //var endDate =  $('#endDate').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  console.log("date filter");
  loadExpenseData();
  //$('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', startDate);
})

function reloadData(){
  loadExpenseData();
}

function loadExpenseData(){
  var startDate =  $('#startDate').val();
  var endDate =  $('#endDate').val();
 
  var link = generateDateRangeLink(startDate, endDate);
  // console.log("")
  // console.log("StartDate: " + startDate);
  console.log("endDate: " + endDate);
  drawTable("{{ route('dashboard.trip') }}", link, startDate, endDate);

  $("#modalBtnSubmit").prop('disabled', false);
  $("#modalBtnUpdate").prop('disabled', false);
}



function drawTable(baselink, paramlink, startDate, endDate){
  // var startDate =  $('#startDate').val();
  // var endDate =  $('#endDate').val();
  var dataFilterSet = "";
  console.log("StartDate: " + startDate);
  console.log("endDate: " + endDate);
  if(startDate !== null || startDate !== ""){
    dataFilterSet = "startDate="+ startDate +",endDate="+ endDate +", ";
  }
  var params = prepareAjaxParams(dataFilterSet + "trip={{$tripModel->id}}, truck={{$modelTruck->id}}, company={{$companyModel->id}}, driver={{$record->driver_id}}") ;

  console.log(params);

  $.ajax({
    'url': "{{route('expense.getAjaxData')}}",
    'method': "GET",
    'contentType': 'application/json',
    data: params
  }).done( function(data) {

    console.log(data);

      $('#expense-table').dataTable( {
          "aaData": data,
          "columns": [
              { "data": "trip_id", responsivePriority: 1, targets: 0 },
              { "data": "truck" , responsivePriority: 2, targets: 1},
              { "data": "company" , responsivePriority: 3, targets: 2 },
              { "data": "driver" , responsivePriority: 4, targets: 3},
              { "data": "ref_no" , responsivePriority: 5, targets: 12},
              { "data": "stock_source", responsivePriority: 6, targets: 4 },
              { "data": "destination" },
              { "data": "item" },
              { "data": "quantity" },
              { "data": "accumulated_total" },
              { "data": "entry_by" },
              { "data": "date" },
              { 
                "data": null,
                "render": function(data, type, row, meta){
                  return '<div class="row">'
                 + '<div class="col icons-option" >'
                // + '<a href="#"><i class="fa-solid fa-eye"></i></a>'
                + '<a href="#!" onclick="editExpense(\''+  row.id + '\', \''+row.ref_no+'\', \''+ row.item +'\', \''+ row.quantity +'\',\''+ row.accumulated_total +'\', \''+ row.entry_by +'\', \''+ row.date +'\', \'gg\')"><i class="fas fa-edit"></i></a>'
                + '<a href="#!" onclick="ajaxDeleteRecord('+ row.id +', \'Expense record for '+ 'Trip ID: ' + row.trip_id + ' and Truck Name: '+ row.truck +'\', \'{{route("expense.index")}}\', \'#expense-table\', \'#ajaxMsgHolder\')"><i class="fa-solid fa-trash-can"></i></a>'
                + '</div>'
                + '</div>';
                  
                }
              }
          ],
          "responsive": true,
          "columnDefs": [
		            { responsivePriority: 1, targets: 0 },
		            { responsivePriority: 2, targets: 1 },
                { responsivePriority: 3, targets: 2 },
		            { responsivePriority: 4, targets: 3 },
                { responsivePriority: 5, targets: 12 },
		            { responsivePriority: 6, targets: 4 },
		        ],
            "bDestroy": true
      })
  });
}

function editExpense(id, refId, item, quantity, total, entryBy, date, gg){
  //alert("editing expense");
  //alert("Expense ID: " + id);
  editID = id;
  //alert(refId + " " + item + " " + quantity + " " + total + " " + entryBy, + " " + date) + " " + gg;
  $("#refID").val(refId);
  $("#item").val(item);
  $("#quantity").val(quantity);
  $("#accumulated_total").val(total);
  $("#entry_by").val(entryBy);
  $("#dateInput").val(date);
  $("#modalTitle").html("Edit Expense ID: #" + id);
  $("#modalBtnSubmit").hide();
  $("#modalBtnUpdate").show();
  $("#expenseModal").modal("show");
  return;

  submitFormModal()
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


function modalBtnClick(actionMethod){
  submitFormModal(actionMethod, "");
}

function modalBtnUpdateClick(actionMethod){
 // alert(editID);
 // return;
  submitFormModal(actionMethod, editID);
}



function submitFormModal(actionMethod, id){
  //console.log(actionMethod);
  //$('#form-expense').validate();
  $('#form-expense').valid();

  $("#modalBtnSubmit").prop('disabled', true);
  $("#modalBtnUpdate").prop('disabled', true);
  $('.disabledComponent').removeAttr("disabled");
  var link = "";
  var method = "";
  if(actionMethod == "store"){
    link += "{{route('expense.store')}}";
    method = "POST";
  }else if(actionMethod == "update"){
    link += "{{route('expense.store')}}" + "/" + id;
    method = "PUT";
  }
  // else if(actionMethod == "delete"){
  //   link += "{{route('expense.destroy', 1)}}";
  //   method = "DELETE";
  // }

  var data = $('#form-expense').serialize();

  $('.disabledComponent').attr("disabled", "disabled");

  console.log("data: " + data);
  //return;

  $.ajax({
           type:method,
           url:link,
           data:data,
           success:function(data){
             // alert(data.message);
              var alertType = "success";
              var msg = data.message;
              if(msg.indexOf('success')<1){
                alertType = 'danger';
              }

            console.log(data);
            $("#ajaxMsgHolder").html(generateAjaxMessage(alertType, data.message));
              $("#expenseModal").modal("hide");
              loadExpenseData();
           }
        });
  
  //return;

  //$('#form-expense').submit();

  //$('#form-expense').submit(function (e){
    
    
    
    

    // var data = new FormData(this);
    // console.log(data);
    
    // $.ajax({
    // 'url': link,
    // 'method': method,
    // 'contentType': 'application/json',
    // data: data,
    // success: function (data) {
    //             alert("success");
    //         }
    // }).done(function(data){
    //   console.log(data);
    // })

    
  //});

  
}
// $('#modalBtnSubmit').click(function(){
//   alert(actionMethod);
  
//     //$('#form-expense').submit();

//     //alert('click modal save');
// })



</script>
<script src="{{asset('/js/globalFunctions.js')}}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->


@endsection

@endif


