<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
