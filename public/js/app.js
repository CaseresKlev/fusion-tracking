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



//require('./bootstrap');