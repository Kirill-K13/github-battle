<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Github\Client;

class HomeController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client;
        $this->client->authenticate('4ecea8431c72918eaf43e2cf284afc36822460ca', null, Client::AUTH_HTTP_TOKEN);
    }

    public function index()
    {
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

        $repositories2 = $this->client->api('repo')->show($request['login2'], $request['repository2']);
        $watchers_count2   = $repositories2['subscribers_count'];
        $stargazers_count2 = $repositories2['stargazers_count'];
        $forks2            = $repositories2['forks'];

        return view('pages.home', compact('avatar_url1', 'name1', 'login1', 'bio1', 'location1', 'email1', 'blog1',
                                          'avatar_url2', 'name2', 'login2', 'bio2', 'location2', 'email2', 'blog2',
                                          'watchers_count1',  'stargazers_count1', 'forks1',
                                          'watchers_count2',  'stargazers_count2', 'forks2')
        );

    }
}
