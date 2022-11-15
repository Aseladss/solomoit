@extends('layouts.adminlayout')
@section('title', 'Ticket Management')
@section('header', 'Ticket Management')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style type="text/css">
    #btn-add{
        float: right;
    }
    #btn-save, #btn-save-edit{
        float: right;
        min-width: 100px;
        margin-right: 15px;
    }
    .bg-blue-active {
    font-size: 11px;
    padding: 2px;
    min-width: 80px;
}
</style>
<div class="row">
    <div class="col-md-12">
       @include('includes.orderlist')
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ticket Info</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msgs" style="display: none; border-radius: 0; margin-bottom: 10px;">
                    <ul style="margin-bottom: 0px;"></ul>
                </div>
                <div id="inv-modal-html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
        <!--<div class="modal-content" ></div>-->
    </div>
</div>
<script type="text/javascript">
$(document).on('click', '#view-in-btn', function () {
        $('#inv-modal-html').html(null);
        var ticket_id = $(this).attr('data-id');
        $.ajax({
            url: "{{ URL:: to('dashboard') }}/" + ticket_id,
            success: function (data)
            {
                $('#inv-modal-html').html(data);
                $('#myModal').modal("show");

            }
        });
    });
    
//    $(document).on("submit", "#ticket-info", function (e) {
//    $('.print-error-msgs').hide();
//    e.preventDefault();
//    var form = $(this);
//    var actionUrl = form.attr('action');
//
//    $.ajax({
//        type: "POST",
//        url: actionUrl,
//        data: form.serialize(),
//        success: function (response)
//        {        
//            console.log(response);
//        }
//    });
//
//});
</script>        
@endsection
