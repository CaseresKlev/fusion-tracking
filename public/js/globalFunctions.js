function upperCaseF(a){
  setTimeout(function(){
      a.value = a.value.toUpperCase();
  }, 1);
}


function generateDateRangeLink(startDate, endDate){
 // startDate =  $('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }).val();
//  endDate =  $('#endDate').datepicker({ dateFormat: 'yy-mm-dd' }).val();

  var sdate = startDate.split("/");
  startDate = sdate[2] + "-" + sdate[0] + "-" + sdate[1];

  var edate = endDate.split("/");
  endDate = edate[2] + "-" + edate[0] + "-" + edate[1];

  var link = "/" +  startDate + "/" + endDate;
  
 // alert(link);
  return link;
  //$('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }).datepicker('setDate', startDate);
}

function resetFilterTable(){
  $('#startDate').val("");
  $('#endDate').val("");
}


function deleteRecord(id, name){
    if(!confirm("Are you sure you want to delete "+ name +"? This cannot be undone.")) {
      return false;
    }
    document.getElementById("form-delete-" + id).submit();
}

function ajaxDeleteRecord(id, name, baseLink, table, msgHolder){
    if(!confirm("Are you sure you want to delete "+ name +"? This cannot be undone.")) {
        return false;
    }
    var link = baseLink + "/" + id
    //alert(callBackFn);
    //return;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        'url': link,
        'type': "DELETE",
        'contentType': 'application/json',
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        data:{
            '_method': 'delete'
        }
      }).done( function(data) {
          var alertType = "success";
          var msg = data.message;
          if(msg.indexOf('sucess')<1){
            alertType = 'danger';
          }

        console.log(data);
        $(msgHolder).html(generateAjaxMessage('success', data.message));
        reloadData();
        //   $(table).dataTable( {
        //       "aaData": data,
        //       "columns": [
        //           { "data": "trip_id", responsivePriority: 1, targets: 0 },
        //           { "data": "truck" , responsivePriority: 2, targets: 1},
        //           { "data": "company" , responsivePriority: 3, targets: 2 },
        //           { "data": "driver" , responsivePriority: 4, targets: 3},
        //           { "data": "ref_no" , responsivePriority: 5, targets: 12},
        //           { "data": "stock_source", responsivePriority: 6, targets: 4 },
        //           { "data": "destination" },
        //           { "data": "item" },
        //           { "data": "quantity" },
        //           { "data": "accumulated_total" },
        //           { "data": "entry_by" },
        //           { "data": "date" },
        //           { 
        //             "data": null,
        //             "render": function(data, type, row, meta){
        //               return '<div class="row">'
        //              + '<div class="col icons-option" >'
        //             // + '<a href="#"><i class="fa-solid fa-eye"></i></a>'
        //             + '<a href="#"><i class="fas fa-edit"></i></a>'
        //             + '<a href="#!" onclick="ajaxDeleteRecord('+ row.id +', \'Expense record for '+ 'Trip ID: ' + row.trip_id + ' and Truck Name: '+ row.truck +'\', \'{{route("expense.index")}}\')"><i class="fa-solid fa-trash-can"></i></a>'
        //             + '</div>'
        //             + '</div>';
                      
        //             }
        //           }
        //       ],
        //       "responsive": true,
        //       "columnDefs": [
        //                 { responsivePriority: 1, targets: 0 },
        //                 { responsivePriority: 2, targets: 1 },
        //             { responsivePriority: 3, targets: 2 },
        //                 { responsivePriority: 4, targets: 3 },
        //             { responsivePriority: 5, targets: 12 },
        //                 { responsivePriority: 6, targets: 4 },
        //             ],
        //         "bDestroy": true
        //   })
      });
}

function generateAjaxMessage(alertType, msg){
    return '<div class="alert alert-'+ alertType +' alert-dismissible fade show" role="alert">'
              +'<strong>'+ msg +'</strong> '
              +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                +'<span aria-hidden="true">&times;</span>'
              +'</button>'
            +'</div>';
}

function prepareAjaxParams(params){
    return params.replaceAll(',' , '&');
}


// Date renderer for DataTables from cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js
$.fn.dataTable.render.moment = function ( from, to, locale ) {
  // Argument shifting
  if ( arguments.length === 1 ) {
      locale = 'en';
      to = from;
      from = 'YYYY-MM-DD';
  }
  else if ( arguments.length === 2 ) {
      locale = 'en';
  }

  return function ( d, type, row ) {
      if (! d) {
          return type === 'sort' || type === 'type' ? 0 : d;
      }

      var m = window.moment( d, from, locale, true );

      // Order and type get a number value from Moment, everything else
      // sees the rendered value
      return m.format( type === 'sort' || type === 'type' ? 'x' : to );
  };
};