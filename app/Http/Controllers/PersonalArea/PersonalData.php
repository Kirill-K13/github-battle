<?php

namespace App\Http\Controllers\PersonalArea;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class PersonalData extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentPlan = $user->subscription('main')->stripe_plan;
        $plan = Plan::getPlanByIdOrFail($currentPlan);
        return view('pages.personal-area.personal-data', compact('user', 'plan'));
    }

    public function changeData (Request $request)
    {
        $user = Auth::user();

        // Validate request
        $rulesName = ($request['name'] != $user->name) ? 'required|string|max:30|min:3|unique:users' : 'required|string|max:30|min:3';
        $rulesEmail= ($request['email'] != $user->email) ? 'required|string|max:50|min:3|unique:users' : 'required|string|max:50|min:3';
        $this->validate( $request, [
            'name' => $rulesName,
            'email' => $rulesEmail
            ]
        );

        $user->update([
            'name'=>$request['name'],
            'email'=>$request['email'],
        ]);

        return redirect()->back();
    }

    public function changeCard(Request $request)
    {
        $this->validate( $request, ['stripeToken' => 'required'] );

        Auth::user()->updateCard($request['stripeToken']);

        return redirect()->back();
    }
}
