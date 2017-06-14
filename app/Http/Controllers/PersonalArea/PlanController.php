<?php

namespace App\Http\Controllers\PersonalArea;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;


class PlanController extends Controller
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

    public function show($id)
    {
        // get the plan by from
        $plan = Plan::getPlanByIdOrFail($id);

        return view('pages.personal-area.plan', compact('plan'));
    }


    public function subscribe(Request $request)
    {
        // Validate request
        $this->validate( $request, ['stripeToken' => 'required', 'plan' => 'required'] );

        //dd($request->get('stripeToken'));

        // User selected plan
        $pickedPlan = $request->get('plan');

        $user = Auth::user();

        try {
            // check subscribed and subscribed with picked plan
            if( $user->subscribed('main') && ! $user->subscribedToPlan($pickedPlan, 'main') ) {

                // changing Plan
                $user->subscription('main')->swap($pickedPlan);

            } else {
                if ( !empty($request->get('trial')) ) {
                    // Create subscription on trial period
                    $user->newSubscription('main', $pickedPlan)
                        ->withCoupon($request->get('coupon'))
                        ->trialDays(5)
                        ->create($request->get('stripeToken'), [
                            'email' => $user->email,
                        ]);
                } else {
                    // Create subscription
                    $user->newSubscription('main', $pickedPlan)
                        ->withCoupon($request->get('coupon'))
                        ->create($request->get('stripeToken'), [
                            'email' => $user->email,
                        ]);
                }
            }
        } catch (Exception $e) {

            return redirect()->back()->withErrors(['status' => $e->getMessage()]);
        }

        return redirect()->route('cabinet')->with('status', 'You are now subscribed to ' . $pickedPlan . ' plan.');
    }

    public function confirmCancellation()
    {
        return view('pages.personal-area.subscriptionCancel');
    }

    public function cancelSubscription(Request $request)
    {
        try {
            $request->user()->subscription('main')->cancel();
        } catch (Exception $e) {
            return redirect()->route('cabinet')->with('status', $e->getMessage());
        }

        return redirect()->route('cabinet')->with('status',
            'Your Subscription has been canceled.'
        );
    }


    public function resumeSubscription(Request $request)
    {
        try {
            $request->user()->subscription('main')->resume();
        } catch (Exception $e) {
            return redirect()->route('cabinet')->with('status', $e->getMessage());
        }

        return redirect()->route('cabinet')->with('status',
            'Your Subscription has been resumed.'
        );
    }
}
