@if(sizeof($tickets) > 0)
<div class="box box-primary">
    <div class="box-header with-border" style="background-color: #fff;">
        <b>MANAGE ORDERS</b>
    </div>
    <div class="box-body no-padding">
        <div class="mailbox-controls">
            <button type="button" class="btn btn-default btn-sm" style="visibility: hidden;"><i class="fa fa-refresh"></i></button>
            <div class="pull-right" id="sent-paginate">
                {{ $tickets->links("pagination::bootstrap-4") }}
            </div>
            <!-- /.pull-right -->
        </div>
        <table class="table table-condensed table-responsive table-striped" id="all-inv-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>REFERENCE</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
            @if($ticket->status == '0')
            <tr style="background-color: #b5b5b5;">
            @endif
            
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->customer_name }}</td>
                <td>{{ $ticket->referance }}</td>
                <td>{{ $ticket->email }}</td>
                <td>{{ $ticket->phone_number }}</td>
                <td>{{ $ticket->created_at }}</td> 
                <td>
                    @if($ticket->status == '1')
                    <span class="label label-primary">pending</span>
                    @elseif($ticket->status == '0')
                    <span class="label label-info">resolved</span>
                    @endif
                </td>
                <td><button class="btn btn-block btn-sm bg-blue-active" id="view-in-btn" data-id="{{ $ticket->id }}">View</button></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-12">
        <div class="alert" role="alert" style="background-color: rgb(243, 156, 18, 0.7); font-weight: 800;">No data to show</div>
    </div>
</div>
@endif

