<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PlanController extends Controller
{
    public function show($id)
    {
        // get the plan by id from cache
        $plan = $this->getPlanByIdOrFail($id);

        return view('pages.personal-area.plan', compact('plan'));
    }


    public function subscribe(Request $request)
    {

        // Validate request
        $this->validate( $request, ['stripeToken' => 'required', 'plan' => 'required'] );

        // User chosen plan
        $pickedPlan = $request->get('plan');


        // Current logged in user
        $user = Auth::user();

        try {
            // check already subscribed and if already subscribed with picked plan
            if( $user->subscribed('main') && ! $user->subscribedToPlan($pickedPlan, 'main') ) {

                // swap if different plan attempt
                $user->subscription('main')->swap($pickedPlan);

            } else {
                // Its new subscription

                // Create subscription
                //dd($request->get('stripeToken'));

                $user->newSubscription('main', $pickedPlan)->create($request->get('stripeToken'), [
                    'email' => $user->email,
                ]);
            }
        } catch (\Exception $e) {

            // Catch any error from Stripe API request and show
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
        } catch ( \Exception $e) {
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
        } catch ( \Exception $e) {
            return redirect()->route('cabinet')->with('status', $e->getMessage());
        }
        return redirect()->route('cabinet')->with('status',
            'Glad to see you back. Your Subscription has been resumed.'
        );
    }


    private function getPlanByIdOrFail($id)
    {
        $plans = Plan::getStripePlans();

        if ( ! $plans ) {
            throw new NotFoundHttpException;
        }

        foreach ($plans as $item) {
            if ($item->id == $id) {
                return $item;
            }
        }
    }
}
