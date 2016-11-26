<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Hash;
use App\User;

class ChangePasswordController extends Controller
{
    /**
     *  returns view of change password form
     */
    public function index()
    {
        if (!Auth::check()) {
            return '';
        }

        return view(
            'auth/changePassword'
        );
    }


    public function changePasswordAction(\Illuminate\Http\Request $request)
    {
        if (!$request->has('submit_password_change')) {
            return;
        }

        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'old_password' => 'required'
        ]);

        $user = User::find((int)Auth::id());

        if(!Hash::check($request->old_password, $user->password))
        {
            return Redirect::back()->withErrors(['Password did not match']);
        }

        $user->name = $request->username;
        $user->email = $request->email;

        if ($request->new_password) {
            if ($request->new_password != $request->repeat_password) {
                return Redirect::back()->withErrors(['Passwords did not match']);
            }

        $user->password = Hash::make($request->new_password);
        }

        if (!$user->save()) {
            return Redirect::back()->withErrors(['Failed to save data to database']);
        }

        return redirect()->route('login');
    }
}