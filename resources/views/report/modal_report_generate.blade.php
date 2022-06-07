<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formReportGenerate" target="_blank" action="" method="GET">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Add Expense</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <!-- <fieldset>
                    <legend>Report Period:</legend> -->
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">From:</label>
                            <input type="text" class="form-control form-control-lg" id="dateFrom" name="date" value="" >
                        </div>   
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="formGroupExampleInput2" class="control-label font-weight-bold">To:</label>
                            <input type="text" class="form-control form-control-lg" id="dateTo" name="dateTo" value="" >
                        </div> 
                        
                        <input type="text" class="form-control form-control-lg" id="reportID" name="reportID" value="" >
                    </div>
                <!-- </fieldset> -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary " id="vmodalReportBtnSubmit" onclick="submitReportRequest();">Generate</button>
            <!-- <button type="button" class="btn btn-primary " id="modalBtnUpdate">Update</button> -->
        </div>
        </div>
    </form>
  </div>
</div>

<script>
// $(document).ready(function() {
//     $("#modalReportBtnSubmit").click(function(){
//     alert("sending");

    
//     });
// });
var linkReport = "";
function showReportGenerateModal(title, id, mode){
    $("#dateFrom").val("");
    $("#dateTo").val("");
    $("#reportID").val("");

    if(mode=="driver"){
        linkReport = "{{route('dashboard.report.driver')}}";
    }else if(mode=="company"){
        linkReport = "{{route('dashboard.report.company')}}";
    }

    $("#reportID").val(id);
    //alert(linkReport);
    //alert(title + " " +id + " " + link)
    $("#modalTitle").html(title, id, linkReport);
    $("#reportModal").modal("show");

    
}

function submitReportRequest(){
   // alert("Submitting form Request");
    //return false;
    var from = $("#dateFrom").val();
    var to = $("#dateTo").val();
    var id = $("#reportID").val();

    //var formatedDate = generateDateRangeLink(from, to);
        
    linkReport += "/" + from + "/" + to + "/" + id;
    window.open(linkReport, '_blank').focus();
}

function initiliazedReportFeatures(){
    //alert("initialized");
    
    $('#dateFrom').datepicker({dateFormat: 'yy-mm-dd'});
    $('#dateTo').datepicker({dateFormat: 'yy-mm-dd'});
}







</script>