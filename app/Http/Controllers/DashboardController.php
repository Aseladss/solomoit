<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Tickethasuser;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tickets = Ticket::orderBy('id', 'DESC')->paginate(10);
        return view('pages.dashboard')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->session()->get('ADMIN_USER_INFO')) {
            $admin_user_info = $request->session()->get('ADMIN_USER_INFO');
            $req_array = array_merge($request->all(), ['user_id' => $admin_user_info['id']]);
            $data = Tickethasuser::create($req_array);
            if ($data) {
                Ticket::where('id', $request->ticket_id)->update(['status' => 0]);
                $referance = Ticket::where('id', $request->ticket_id)->get();
                $details['email'] = $referance[0]->email;
                $details['subject'] = 'Ticket is resolved (Ref - ' . $referance[0]->referance . ' )';
                $details['body'] = "<p>Dear " . $referance[0]->customer_name . ",</p><p>This is regarding the ticket that we issued with the reference number - ".$referance[0]->referance."</p><p>" . $request->comments . "</p><br><strong>Thank you!</strong>";
                dispatch(new \App\Jobs\SendEmailJob($details));
                $tickets = Ticket::orderBy('id', 'DESC')->paginate(10);
                return view('pages.dashboard')->with('tickets', $tickets);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $ticketdata = DB::table('tickets')->select('tickets.*', 'tickethasusers.comments')->leftJoin('tickethasusers', 'tickets.id', '=', 'tickethasusers.ticket_id')->where('tickets.id', $id)->get();
        return view('includes.ticket')->with('ticketdata', $ticketdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
