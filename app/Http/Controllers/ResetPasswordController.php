<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function create(): View
    {
        return view('verification.reset-password');
    }
}
