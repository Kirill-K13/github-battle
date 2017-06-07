<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Github\Client;

class SearchGithubController extends Controller
{
    public function __construct()
    {
        $this->client = new Client;

        $this->client->authenticate(env('GITHUB_USERNAME'), env('GITHUB_PASSWORD'), Client::AUTH_HTTP_PASSWORD);
    }

    public function search(Request $request)
    {
        $lang = empty($request['lang']) ? '' : '+language:'.$request['lang'];
        $search = $this->client->api('search')->repositories($request['search'] . $lang, 'forks', 'desc');

        if ($search['total_count'] == 0) {
            $error_search = 'Repository not found!';
            return view('pages.search', compact('error_search'));
        }

        return view('pages.search', compact('search'));
    }
}
