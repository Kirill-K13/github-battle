<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Stripe\Stripe;
use Exception;

class Plan extends Model
{
    public static function getStripePlans()
    {
        // Set the API Key
        Stripe::setApiKey(User::getStripeKey());

        //Cache::forget('stripe.plans');
        try {
            // Fetch all the Plans and cache it
            return Cache::remember('stripe.plans', 60*24, function() {

                // If the item does not exist in the cache:
                return \Stripe\Plan::all()->data;

            });
        } catch (Exception $e ) {
            return false;
        }
    }
}
