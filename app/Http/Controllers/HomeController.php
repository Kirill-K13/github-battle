<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Github\Client;
use App\Models\BestResult;
use Exception;

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
        return view('pages.home');
    }

    public function getRepositories(Request $request)
    {
        $repositories = $this->client->api('user')->repositories($request['login']);

        foreach ($repositories as $item) {
            $repoNames[] = $item['name'];
        }

        return json_encode($repoNames);
    }

    public function getDataRepository(Request $request)
    {
        // Validation:
        $repositoryRules = 'required|string|not_in:Repository';

        $this->validate($request, [
            'repository1' => $repositoryRules,
            'repository2' => $repositoryRules,
        ]);

        try {
            $userFirst  = $this->client->api('user')->show($request['login1']);
            $userSecond = $this->client->api('user')->show($request['login2']);

            $repositoryFirst  = $this->client->api('repo')->show($request['login1'], $request['repository1']);
            $repositorySecond = $this->client->api('repo')->show($request['login2'], $request['repository2']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Whoops! Something went wrong!');
        }

        $rating1 = ($repositoryFirst['forks'] * 3) + ($repositoryFirst['subscribers_count'] * 2) + $repositoryFirst['stargazers_count'];
        $rating2 = ($repositorySecond['forks'] * 3) + ($repositorySecond['subscribers_count'] * 2) + $repositorySecond['stargazers_count'];

        $userFirst['win']  = '';
        $userSecond['win'] = '';
        $rating1 > $rating2 ? $userFirst['win'] = 'user-win' : $userSecond['win'] = 'user-win';

        // Save best result in DB:
        if ($rating1 > $rating2) {
            if ( ($result = BestResult::where('login', $userFirst['login'])->where('repository', $request['repository1'])->first() ) == null ) {
                BestResult::create([
                    'login'=>$userFirst['login'],
                    'repository'=>$request['repository1'],
                    'repository_url'=>$repositoryFirst ['html_url'],
                    'avatar_url'=>$userFirst['avatar_url'],
                    'rating'=>$rating1
                ]);
            }
            elseif ($result->rating != $rating1) {
                $result->update(['rating'=>$rating1]);
            }
        }
        elseif($rating1 < $rating2) {
            if ( ($result = BestResult::where('login', $userSecond['login'])->where('repository', $request['repository2'])->first() ) == null ) {
                BestResult::create([
                    'login'=>$userSecond['login'],
                    'repository'=>$request['repository2'],
                    'repository_url'=>$repositorySecond ['html_url'],
                    'avatar_url'=>$userSecond['avatar_url'],
                    'rating'=>$rating2
                ]);
            }
            elseif ($result->rating != $rating2) {
                $result->update(['rating'=>$rating2]);
            }
        }

        return view('pages.home', compact('userFirst', 'repositoryFirst', 'rating1', 'userSecond', 'repositorySecond', 'rating2'));
    }
}
