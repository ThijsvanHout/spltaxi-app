<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;


use App\Models\User;


class AdminController extends Controller
{
    //
    public function index()
    {
        return view('layouts.dashboard');
    }
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/bookings');
        }
    
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $user = \App\Models\Admin::where('email', $request->email)->first();
        
        if ($user) {
            // User exists, now try to authenticate
            if (Auth::guard('admin')->attempt($credentials)) {
				//dd($user->email, $user->password);
				$message = $user->email;
				
                 return redirect()->intended('/admin/bookings')->with('success', 'Successfully logged in!');
            } else {
                 return redirect()->back()->with('error', 'Incorrect password!');
            }
        } else {
            return redirect()->back()->with('error', 'Email & Password are Not Correct!');
        }
    }

	public function passwordForm($id)
    {
		
		/*$user = \App\Models\Admin::where('email', 'tijs@spl.taxi')->first();
		$inputPassword = $user->password;
		
        
        //$user = auth()->guard('web')->user();
		$raw_password = 'testpssw';
		//$hashed_password = Hash::make($raw_password);
		//dd($hashed_password);
		$hashed_password = bcrypt($raw_password);
		//dd($hashed_password);
		if (password_verify($inputPassword, $hashed_password)){
		//if (Auth::guard('admin')->attempt('tijs@spl.taxi', 'password')) {
			dd("Oke");
		}
		else {
			dd("Fout");
		}
		dd($hashed_password);*/

		$admin = \App\Models\Admin::find($id);
		
        return view('admin.password', ['admin' => $admin]);
    }
	
	public function password(Request $request)
    {
		
		 $request->validate([
            'email' => 'required|email',
            'password' => 'required',
			'oldpassword' => 'requireed',
			'newpassword' => 'required',
			'passwordconfirm' => 'required' 
        ]);

		$credentials = $request->only('email', 'password');
		$user = \App\Models\Admin::where('email', $request->email)->first();
		
		if ($user){
			if (Auth::guard('admin')->attempt($credentials)) {
				if ($request->newpassword !== $request->passwordconfirm){
					return redirect()->back()->with('error', "passwords don't match!");
				}
				else {
					// Wijzig het wachtwoord van de gebruiker
					$user->password = bcrypt($request->newpassword);
					$user->save();
				}
			}
			else {
				return redirect()->back()->with('error', "Old password incorrect");
			}
		}
		else {
			return redirect()->back()->with('error', "Email incorrect");
		}
		
        //return redirect()->intended('/admin/password')->with('success', 'Password changed!');
		 return redirect('/admin')->with('success', 'Password changed!');
    }
	
	

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success', 'Successfully Logged Out!');;
    }
	
	public function showAdmins()
    {
		$admins = \App\Models\Admin::orderBy('name')->get();
        return view('admin.admins', ['admins' => $admins]);
    }
	
	public function createAdmin()
    {
        return view('admin.addadmins');
    }
	
	public function editadmin($id)
    {
		$admin = \App\Models\Admin::find($id);
		
		return view('admin.editadmins', ['admin' => $admin]);
    }
	
	public function storeAdmin(Request $request)
    {        
        $admin = new \App\Models\Admin();
        $admin->name = $request['name'];
		$admin->email = $request['email'];
		if ($request->newpassword !== $request->passwordconfirm){
					return redirect()->back()->with('error', "passwords don't match!");
				}
		$admin->password = bcrypt($request->newpassword);		
		$admin->role = $request['role'];
        $admin->save();
        return redirect()->route('admin.admins');
    }
	
    public function updateAdmin(Request $request)
    {

        //dd($request);
        $data = \App\Models\Admin::where('id', $request->id)->update([
            'name' => $request->name,
			'email' => $request->email,
			'role' => $request->role
        ]);

        //Session::flash('success', 'Data Updated successfully!');

        return redirect()->route('admin.admins');
    }
}
