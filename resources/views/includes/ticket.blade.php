@if(sizeof($ticketdata) > 0)
<form id="ticket-info" action="{{ URL('dashboard') }}" method="POST">
<table class="table table-striped table-bordered table-condensed">
    {!! csrf_field() !!}
    
    <tbody>
        @foreach ($ticketdata as $ticket)
        <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
        <tr>
            <td>ID</td>
            <td>{{ $ticket->id }}</td>
        </tr>
        <tr>
            <td>CUSTOMER NAME</td>
            <td>{{ $ticket->customer_name }}</td>
        </tr>
        <tr>
            <td>REFERENCE</td>
            <td>{{ $ticket->referance }}</td>
        </tr>
        <tr>
            <td>EMAIL</td>
            <td>{{ $ticket->email }}</td>
        </tr>
        <tr>
            <td>PHONE</td>
            <td>{{ $ticket->phone_number }}</td>
        </tr>
        <tr>
            <td>DESCRIPTION</td>
            <td>{{ $ticket->problem_description }}</td>
        </tr>
        <tr>
            <td>Comment</td>
            <td>
                <textarea class="form-control form-control-sm" name="comments" id="comments" rows="4" spellcheck="false" {{ ($ticket->status == 0) ? 'readonly="true"' : ''}}>{{ $ticket->comments }}</textarea>
            </td>
        </tr>
    </tbody>
</table>
<div class="row">
    <div {{ ($ticket->status == 0) ? 'style=display:none' : ''}} >
        <button type="submit" class="btn btn-primary btn-sm" id="btn-save">Save</button>
    </div>
</div>
</form>
@endforeach
@endif