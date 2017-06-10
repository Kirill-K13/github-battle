<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class AreaController extends Controller
{
    public function index()
    {
        // Get all plans from stripe api
        $plans = Plan::getStripePlans();

        // Check is subscribed
        $is_subscribed = Auth::user()->subscribed('main');

        // If subscribed get the subscription
        $subscription = Auth::user()->subscription('main');

        return view('pages.area', compact('plans', 'is_subscribed', 'subscription'));
    }
}
