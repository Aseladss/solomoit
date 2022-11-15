@extends('layouts.adminlayout')
@section('title', 'Ticket')
@section('content')
<style type="text/css">
    #btn-add{
        float: right;
    }
    #btn-save, #btn-save-edit{
        float: right;
        min-width: 100px;
        margin-right: 15px;
    }
</style>
<div class="container">
<div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <h5>PLEASE CREATE A TICKET HERE</h5>
        <div class="box box-primary">
            <form id="ticket-form" action="{{ URL('ticket') }}" method="POST">
                {!! csrf_field() !!}
                <div class="box-header with-border">
                    <h3 class="box-title">OPEN A TICKET</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="alert alert-danger print-error-msgs" style="display: none; border-radius: 0; margin-bottom: 10px;">
                        <ul style="margin-bottom: 0px;"></ul>
                    </div>
                    <div class="alert alert-success print-success-msgs" style="display: none; border-radius: 0; margin-bottom: 10px;"></div>
                    <div class="form-group">
                        <label for="customer_name">Your name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label for="problem_description">Explain your problem</label>
                        <textarea class="form-control" rows="4" id="problem_description" name="problem_description" placeholder="Please explain your problem here"></textarea>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <h5>SEARCH YOUR TICKETS HERE</h5>
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">SEARCH MY TICKET</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="search-form" action="{{ URL('ticket') }}" method="POST">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reference number</label>
                        <input type="text" class="form-control form-control-sm" id="reference" name="reference" placeholder="Enter the reference number">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Search</button>
                    </div>
                </div>
            </form>
            <div class="alert alert-secondary show-ticket-info" style="display: none; border-radius: 0; margin-bottom: 10px;">
                <table class="table table-condensed">
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).on("submit", "#ticket-form", function (e) {
    $('.print-error-msgs').hide();
    $(".print-success-msgs").hide();
    e.preventDefault();
    var form = $(this);
    var actionUrl = form.attr('action');
    
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(),
        success: function (response)
        {
            
            console.log(response);
            try {
                var data = JSON.parse(response);
                if (data.status) {
                    $('#ticket-form').find("input[type=text],input[type=email],textarea").val("");
                    $(".print-success-msgs").html('');
                    $(".print-success-msgs").css('display', 'block');
                    $(".print-success-msgs").html(data.msg);
                } else {
                    var errors = data.errors;
                    printErrorMsgs(errors);
                }
                
            } catch (e) {
                console.log(e);
            }
        }
    });
    
});

//end submitting the ticket

function printErrorMsgs(msg) {
    $(".print-error-msgs").find("ul").html('');
    $(".print-error-msgs").css('display', 'block');
    $.each(msg, function (key, value) {
        $(".print-error-msgs").find("ul").append('<li>' + value + '</li>');
    });
}
//end display errors

$(document).on("submit", "#search-form", function (e) {
    $('.show-ticket-info').hide();
    e.preventDefault();
    var reference = $('#reference').val();
    $.ajax({
        url: "{{ URL:: to('ticket') }}/" + reference,
        success: function (response)
        {
            var data = JSON.parse(response);
            if (data.status) {
                console.log(data.data[0]);
                $(".show-ticket-info").find("tbody").html('');
                $(".show-ticket-info").css('display', 'block');
                $.each(data.data[0], function (key, value) {
                    if (key === 'status') {
                        value = value === 1 ? 'pending' : 'resolved';
                    }
                    if (key === 'comments') {
                        value = value === null ? 'No comments yet' : value;
                    }
                    $(".show-ticket-info").find("tbody").append('<tr><td>' + key.replace("_", " ") + '</td><td>' + value + '</td></tr>');
                });
            } else {
                alert(data.msg);
            }
            
        }
    });
});

//end searching ticket data

</script>        
@endsection
