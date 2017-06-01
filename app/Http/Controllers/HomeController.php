<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $client;

    /*
     * Github username
     *
     * @var string
     * */
    private $username;

    public function __construct(\Github\Client $client)
    {
        $this->client = $client;
        $this->username = env('KnpLabs');
    }

    public function index()
    {
        // Find user
        $repos = $this->client->api('user')->find('Kirill-K13');

        // Info for user
        //$repos = $this->client->api('user')->show('KnpLabs');

        //Get repos that a specific user is watching
        //$repos = $this->client->api('user')->watched('ornicar');




        //Repo / Stargazers API

        $stargazers = $this->client->api('repo')->stargazers();
        $stargazers = $stargazers->all('twbs', 'bootstrap');

        dd($stargazers);
    }
}
