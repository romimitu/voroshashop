<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:dashboard-list');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $letestOrder = Order::orderBy('created_at', 'desc')
        ->where('operational_status', '!=', 'Cancel')
        ->where('operational_status', '!=', 'Complete')
        ->paginate(10);
        $letestOrderCompleted = Order::orderBy('created_at', 'desc')
        ->where('operational_status', '=', 'Complete')
        ->paginate(10);
        return view('admin.dashboard',compact('letestOrder','letestOrderCompleted'));
    }
}
