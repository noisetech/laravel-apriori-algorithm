<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashobardController extends Controller
{
    public function index(){
        return view('pages.be.dashboard');
    }
}
