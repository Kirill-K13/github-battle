<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Stripe\Stripe;
use \Stripe\Charge;




class StripeController extends Controller
{
    public function __construct() {
        // Authentication:
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function index() {
        return view('pages.stripe');
    }

    public function test() {

    }
}
