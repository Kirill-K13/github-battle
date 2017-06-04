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
        //$this->client->authenticate('65ed705caa568784fd8283540d79ca4a4a7ee22d', null , Client::AUTH_HTTP_TOKEN);

        /* CLIENT_ID: */
        //$this->client->authenticate('Iv1.9b60535f0a322205', 'd58f2fb40d7c551e46f5e79258ac6fcecce82a1b', Client::AUTH_URL_CLIENT_ID);

        /* Password: */
        $this->client->authenticate('Kirill-K13', 'Auchan15', Client::AUTH_HTTP_PASSWORD);

        /* Testing requests limit */
        //dd($this->client->api('rate_limit')->getRateLimits());
    }

    public function index()
    {
        $results = BestResult::all()->sortByDesc('rating')->take(3);

        return view('pages.home', compact('results'));
    }

    public function getRepositories(Request $request)
    {
        // Validation:
        $user = $this->client->api('user')->find($request['login'])['users'];
        if (empty($user)) {
            return 'ERROR: user not found!';
        }

        $repositories = $this->client->api('user')->repositories($request['login']);
        foreach ($repositories as $item) $reposName[] = $item['name'];

        return json_encode($reposName);
    }

    public function getDataRepository(Request $request) {

        // Validation:
        $this->validate($request, [
            'repository1' => 'required|string|not_in:Repository',
            'repository2' => 'required|string|not_in:Repository',
        ]);

        $user1 = $this->client->api('user')->show($request['login1']);
        $avatar_url1 = $user1['avatar_url'];
        $name1       = $user1['name'];
        $login1      = $user1['login'];
        $bio1        = $user1['bio'];
        $location1   = $user1['location'];
        $email1      = $user1['email'];
        $blog1       = $user1['blog'];

        $user2 = $this->client->api('user')->show($request['login2']);
        $avatar_url2 = $user2['avatar_url'];
        $name2       = $user2['name'];
        $login2      = $user2['login'];
        $bio2        = $user2['bio'];
        $location2   = $user2['location'];
        $email2      = $user2['email'];
        $blog2       = $user2['blog'];

        $repositories1 = $this->client->api('repo')->show($request['login1'], $request['repository1']);
        $watchers_count1   = $repositories1['subscribers_count'];
        $stargazers_count1 = $repositories1['stargazers_count'];
        $forks1            = $repositories1['forks'];
        $repositories1_name= $request['repository1'];

        $repositories2 = $this->client->api('repo')->show($request['login2'], $request['repository2']);
        $watchers_count2   = $repositories2['subscribers_count'];
        $stargazers_count2 = $repositories2['stargazers_count'];
        $forks2            = $repositories2['forks'];
        $repositories2_name= $request['repository2'];

        $rating1 = ($forks1 * 3) + ($watchers_count1 * 2) + $stargazers_count1;
        $rating2 = ($forks2 * 3) + ($watchers_count2 * 2) + $stargazers_count2;

        // Save best result in DB:
        if ($rating1 > $rating2) {
            if ( ($result = BestResult::where('login', $login1)->where('repository', $repositories1_name)->first() ) == null)
                BestResult::create([
                    'login'=>$login1, 'repository'=>$repositories1_name, 'avatar_url'=>$avatar_url1, 'rating'=>$rating1
                ]);
            elseif ($result->rating != $rating1)
                $result->update(['login'=>$login1, 'repository'=>$repositories1_name, 'avatar_url'=>$avatar_url1, 'rating'=>$rating1]);
        } else {
            if ( ($result = BestResult::where('login', $login2)->where('repository', $repositories2_name)->first() ) == null)
                BestResult::create([
                    'login'=>$login2, 'repository'=>$repositories2_name, 'avatar_url'=>$avatar_url2, 'rating'=>$rating2
                ]);
            elseif ($result->rating != $rating2)
                $result->update(['login'=>$login2, 'repository'=>$repositories2_name, 'avatar_url'=>$avatar_url2, 'rating'=>$rating2]);
        }

        $results = BestResult::all()->sortByDesc('rating')->take(3);

        return view('pages.home', compact('avatar_url1', 'name1', 'login1', 'bio1', 'location1', 'email1', 'blog1',
                                          'avatar_url2', 'name2', 'login2', 'bio2', 'location2', 'email2', 'blog2',
                                          'watchers_count1',  'stargazers_count1', 'forks1', 'repositories1_name',
                                          'watchers_count2',  'stargazers_count2', 'forks2', 'repositories2_name',
                                          'rating1', 'rating2',
                                          'results'
            )
        );

    }
}
