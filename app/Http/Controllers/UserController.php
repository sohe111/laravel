<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Validator;
use Sentinel;
use Activation;

class UserController extends Controller
{
	 public function index()
    {
    	$roles = Role::allRole();
        $users = User::with(['withRoles', 'withActivation' ])->paginate(10);
    	return view('backend.user.users',compact('users','roles'));
    }

     public function create()
    {
    	$roles  = Role::allRole();
        return view('backend.user.add-user', compact('roles'));
    }

     public function store(Request $request)
    {
        Validator::make($request->all(), [
            'first_name'            => 'required',
            'email'                 => 'required|unique:users|max:255',
            'last_name'             => 'required|min:2|max:30',
            'user_role'             => 'required|min:2|max:30',
            'password'              => 'confirmed|required|min:5|max:30',
            'password_confirmation' => 'required|min:5|max:30'
        ])->validate();

        try {

            $user       = Sentinel::register($request->all());
            $role       = Sentinel::findRoleBySlug($request->user_role);
            $role->users()->attach($user);
            $activation = Activation::create($user);

            Activation::complete($user, $activation->code);
           
                   

            return redirect()->back()->with('success', __('successfully_added'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('test_mail_error_message'));
        }
   
    }

     public function updateUserInfo(Request $request, $id)
    {
        Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required|min:2|max:30',
           
        ])->validate();

        $user                       = User::find($id);

        $user->first_name           = $request->first_name;
        $user->last_name            = $request->last_name;

        $user->newsletter_enable    = $request->newsletter_enable;

        $user->save();

        return redirect()->back()->with('success', __('successfully_updated'));
    }

    }
