<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Services;
use App\Models\SubService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Services::where('isVisible', true)->get();
        $doctors = Doctors::where('isVisible', true)->where('isRemoved', false)->get();
        $subServices = SubService::all();
        return view('dental-front-face-index', compact('services', 'doctors', 'subServices'));
    }
}
