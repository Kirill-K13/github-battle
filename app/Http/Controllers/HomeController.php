<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Github\Client;
use App\Models\BestResult;

class HomeController extends Controller
{
    protected $client;

    public function __construct()
    {
        /*
        For requests using Basic Authentication or OAuth, you can make up to 5,000 requests per hour.
        For unauthenticated requests, the rate limit allows you to make up to 60 requests per hour.

        Default Number of search results - 30
        Fixed: add param in request
        'page' => 1,
        'per_page' => 100,
        */

        $this->client = new Client;

        /*
         * Authenticate in API:
         */

        /* Token: */
        //$this->client->authenticate(env('GITHUB_TOKEN'), null , Client::AUTH_HTTP_TOKEN);

        /* CLIENT_ID: */
        //$this->client->authenticate(env('GITHUB_CLIENT_ID'), env('GITHUB_CLIENT_SECRET'), Client::AUTH_URL_CLIENT_ID);

        /* Password: */
            $this->client->authenticate(env('GITHUB_USERNAME'), env('GITHUB_PASSWORD'), Client::AUTH_HTTP_PASSWORD);

        /* Testing requests limit */
        //dd($this->client->api('rate_limit')->getRateLimits());
    }


    public function index()
    {
        return view('pages.home', compact('results'));
    }

    public function searchGithub(Request $request) {
        $search = $this->client->api('search')->repositories($request['search'], 'stars');

        if ($search['total_count'] == 0) {
            return view('pages.search')->with('error_search', 'Repository not found!');
        }

        return view('pages.search', compact('search'));
    }

    public function getRepositories(Request $request)
    {
        $repositories = $this->client->api('user')->repositories($request['login']);

        foreach ($repositories as $item) {
            $repoNames[] = $item['name'];
        }

        return json_encode($repoNames);
    }

    public function getDataRepository(Request $request) {

        // Validation:
        $repositoryRules = 'required|string|not_in:Repository';

        $this->validate($request, [
            'repository1' => $repositoryRules,
            'repository2' => $repositoryRules,
        ]);

        $user1 = $this->client->api('user')->find($request['login1'])['users'];
        $user2 = $this->client->api('user')->find($request['login2'])['users'];
        if (empty($user1) || empty($user2)) {
            return redirect()->back()->with('error', 'ERROR: user not found!');
        }

        $userFirst  = $this->client->api('user')->show($request['login1']);
        $userSecond = $this->client->api('user')->show($request['login2']);

        $repositoryFirst  = $this->client->api('repo')->show($request['login1'], $request['repository1']);
        $repositorySecond = $this->client->api('repo')->show($request['login2'], $request['repository2']);

        $rating1 = ($repositoryFirst['forks'] * 3) + ($repositoryFirst['subscribers_count'] * 2) + $repositoryFirst['stargazers_count'];
        $rating2 = ($repositorySecond['forks'] * 3) + ($repositorySecond['subscribers_count'] * 2) + $repositorySecond['stargazers_count'];

        // Save best result in DB:
        if ($rating1 > $rating2) {
            if ( ($result = BestResult::where('login', $userFirst['login'])->where('repository', $request['repository1'])->first() ) == null) {
                BestResult::create([
                    'login'=>$userFirst['login'], 'repository'=>$request['repository1'], $userFirst['avatar_url'], 'rating'=>$rating1
                ]);
            }
            elseif ($result->rating != $rating1) {
                $result->update(['rating'=>$rating1]);
            }
        } else {
            if ( ($result = BestResult::where('login', $userSecond['login'])->where('repository', $request['repository2'])->first() ) == null) {
                BestResult::create([
                    'login'=>$userSecond['login'], 'repository'=>$request['repository2'], $userSecond['avatar_url'], 'rating'=>$rating2
                ]);
            }
            elseif ($result->rating != $rating2) {
                $result->update(['rating'=>$rating2]);
            }
        }

        return view('pages.home', compact('userFirst', 'repositoryFirst', 'rating1', 'userSecond', 'repositorySecond', 'rating2'));
    }

    public function topRepositories() {

        $results = BestResult::all()->sortByDesc('rating')->take(10);

        return view('pages.topRepo', compact('results'));
    }

}
