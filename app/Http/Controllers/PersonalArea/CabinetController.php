<?php

namespace App\Http\Controllers\PersonalArea;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;



class CabinetController extends Controller
{
    public function index()
    {
        // Get all plans from stripe api
        $plans = Plan::getStripePlans();

        // Check is subscribed
        $is_subscribed = Auth::user()->subscribed('main');

        // If subscribed get the subscription
        // return subscription or null
        $subscription = Auth::user()->subscription('main');


        return view('pages.personal-area.cabinet', compact('plans', 'is_subscribed', 'subscription'));
    }
}
