<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Ticket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('pages.ticket');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'customer_name' => 'required|max:100',
                    'email' => 'required|email|max:150',
                    'phone_number' => 'required|numeric|digits:10',
                    'problem_description' => 'required|max:300'
        ]);
        if ($validator->fails()) {
            $arr = array('msg' => 'Validation Errors', 'status' => false, 'errors' => $validator->getMessageBag()->toArray());
            return json_encode($arr);
        } else {
            $randomString = $this->generateReference();
            $req_array = array_merge($request->all(), ['referance' => $randomString, 'status' => 1]);
            try {
                $data = Ticket::create($req_array);
                if ($data) {
                    $referance = Ticket::where('referance', $randomString)->get();
                    $arr = array('msg' => 'Please use the following referance number for further inquiries '.$referance[0]->referance, 'status' => true);
                    $details['email'] = $referance[0]->email;
                    $details['subject'] = 'New Ticket Created (Ref - '.$referance[0]->referance.' )';
                    $details['body'] = "<p>Dear ".$referance[0]->customer_name.",</p><p>Thank you for using Ticket.com, You have successfully raised your ticket. The ticket will be assigned to a ticketing agent asap. you can follow up your ticket with the following ticket number.</p><p>".$referance[0]->referance."</p><p>Also note that once the agent finish your ticket we will send an email to this email address.</p><br><strong>Thank you!</strong>";
                    dispatch(new \App\Jobs\SendEmailJob($details));
                    return json_encode($arr);
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                Log::channel('custom')->error('database exception while creating the ticket' . $ex->getMessage());
                $arr = array('msg' => 'Technical Error', 'status' => false, 'errors' => array('db_error' => 'Technical Error occured. Please contact IT assistance'));
                return json_encode($arr);
            }
        }
    }

    private function generateReference() {
        $randomString = Str::random(30);
        $user = Ticket::where('referance', '=', $randomString)->first();
        if ($user === null) {
            return $randomString;
        } else {
            $this->generateReference();
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $ticketdata = DB::table('tickets')->select('tickets.id','tickets.referance','tickets.customer_name','tickets.email','tickets.phone_number','tickets.status','tickets.problem_description','tickets.created_at','tickethasusers.comments')->leftJoin('tickethasusers', 'tickets.id', '=', 'tickethasusers.ticket_id')->where('tickets.referance', $id)->get();
        if ($ticketdata->count() > 0) {
            $arr = array('msg' => 'Success', 'status' => true, 'data' => $ticketdata);
        }else{
            $arr = array('msg' => 'Ticket not found!', 'status' => false);
        }
        return json_encode($arr);
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
