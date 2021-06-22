<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Sentinel;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
    	return view('backend.Auth.login');
    }
       public function login(Request $request){
        $request->validate([
            'email'         => ['required', 'string', 'email', 'max:255'],
            'password'      => ['required', 'string'],
        ]);
  
        $user = User::where('email', $request->email)->first();
        if (blank($user)) {
            return redirect()->back()->with(['error' => __('your_email_is_invalid')]);
        } 
        try {

            if (!Hash::check($request->get('password'), $user->password)) {
                return redirect()->back()->with(['error' => 'Invalid password !']);
            }

            Sentinel::authenticate($request->all());

            return view('backend.pages.dashboard');

        } catch (NotActivatedException $e) {

            return redirect()->back()->with(['error' => __('your_account_is_not_activated')]);
        }
    }
    public function logout()
    {
        Sentinel::logout();

        return redirect('/');
    }
}
