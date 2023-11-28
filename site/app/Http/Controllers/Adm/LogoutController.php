<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function perform()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/adm/login');
    }
}
