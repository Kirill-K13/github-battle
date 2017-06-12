<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use \Github\Client;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->client = new Client;
        $this->client->authenticate(env('GITHUB_USERNAME'), env('GITHUB_PASSWORD'), Client::AUTH_HTTP_PASSWORD);
    }

    public function index()
    {
        // Check is subscribed
        $is_subscribed = Auth::user()->subscribed('main');
        $access = $is_subscribed ? '' : 'disabled';

        // Get repositories watchers
        $repositories = $this->client->api('current_user')->watchers()->all();
        // Get users following
        $users = $this->client->api('current_user')->follow()->all();

        return view('pages.eventTracking.tracking', compact('repositories', 'users', 'is_subscribed', 'access'));
    }

    public function add_watch(Request $request)
    {
        // Check is subscribed
        if(!Auth::user()->subscribed('main')) {
            return redirect()->back();
        }

        $this->validate($request, [
            'login' => 'required|string|min:2',
            'repository' => 'required|string|not_in:Choose repository',
        ]);

        // Create subscribe:
        try {
            $this->client->api('current_user')->watchers()->watch($request['login'], $request['repository']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Whoops! Something went wrong!');
        }

        return redirect()->back();
    }

    public function del_watch(Request $request)
    {
        // Check is subscribed
        if(!Auth::user()->subscribed('main')) {
            return redirect()->back();
        }

        $login = substr( $request['full_name'], 0, strpos($request['full_name'], '/') );
        $repoName = substr( $request['full_name'], ( strpos($request['full_name'], '/') ) + 1 );

       // Remove subscribe:
       $this->client->api('current_user')->watchers()->unwatch($login, $repoName);

       return redirect()->back();
    }

    public function add_follow(Request $request)
    {
        // Check is subscribed
        if(!Auth::user()->subscribed('main')) {
            return redirect()->back();
        }

        // Create subscribe:
        try {
            $this->client->api('current_user')->follow()->follow($request['login']);
        } catch (Exception $e) {
            return redirect()->back()->with('userError', 'ERROR: user not found!');
        }

        return redirect()->back();
    }

    public function del_follow(Request $request)
    {
        // Check is subscribed
        if(!Auth::user()->subscribed('main')) {
            return redirect()->back();
        }

        // Remove subscribe:
        $this->client->api('current_user')->follow()->unfollow($request['login']);

        return redirect()->back();
    }

}
