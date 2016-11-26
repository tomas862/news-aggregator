<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

        dd($request);
    }
}