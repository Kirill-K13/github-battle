<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Github\Client;

class HomeController extends Controller
{
    protected $client;

    public function __construct()
    {
        /*
        For requests using Basic Authentication or OAuth, you can make up to 5,000 requests per hour.
        For unauthenticated requests, the rate limit allows you to make up to 60 requests per hour.
        */

        $this->client = new Client;
        $this->client->authenticate('4ecea8431c72918eaf43e2cf284afc36822460ca', null, Client::AUTH_HTTP_TOKEN);
    }

    public function index()
    {
        dd($this->client ->api('user')->repositories('Kirill-K13'));

        return view('pages.home');
    }

    public function getRepository(Request $request)
    {
        $repositories = $this->client ->api('user')->repositories($request['login']);
        foreach ($repositories as $item) $reposName[] = $item['name'];

        return json_encode($reposName);
    }

    public function getDataRepository(Request $request) {

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

        $rating1 = $forks1 * 3 + $watchers_count1 * 2 + $stargazers_count1;
        $rating2 = $forks2 * 3 + $watchers_count2 * 2 + $stargazers_count2;

        return view('pages.home', compact('avatar_url1', 'name1', 'login1', 'bio1', 'location1', 'email1', 'blog1',
                                          'avatar_url2', 'name2', 'login2', 'bio2', 'location2', 'email2', 'blog2',
                                          'watchers_count1',  'stargazers_count1', 'forks1', 'repositories1_name',
                                          'watchers_count2',  'stargazers_count2', 'forks2', 'repositories2_name',
                                          'rating1', 'rating2'
            )
        );

    }
}
