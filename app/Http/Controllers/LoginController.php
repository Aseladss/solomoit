<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class LoginController extends Controller {

    public function index(Request $request) {
        if ($request->session()->get('ADMIN_USER_INFO')) {
            $request->session()->forget('ADMIN_USER_INFO');
        }
        return view('pages.login');
    }

    public function login(Request $request) {
        try {
            $checkuser = DB::select('select * from users where email = ? ', [$request->email]);
            if ($checkuser) {
                if (Hash::check($request->password, $checkuser[0]->password)) {
                    $admin_user_info = array('id' => $checkuser[0]->id, 'name' => $checkuser[0]->name, 'email' => $checkuser[0]->email);
                    $request->session()->put('ADMIN_USER_INFO', $admin_user_info);
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->back()->with(['message' => 'Password mismatched', 'status' => false]);
                }
            } else {
                return redirect()->back()->with(['message' => 'User not found', 'status' => false]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::channel('custom')->error('database exception login the user' . $ex->getMessage());
            return redirect()->back()->with(['message' => 'Technical Error', 'status' => false]);
        }
    }

}
