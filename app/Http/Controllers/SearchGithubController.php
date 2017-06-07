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

        // Create links for download zip:
        foreach ($search['items'] as $item) {
            $links[$item['id']] = substr($item['archive_url'], 0, strpos($item['archive_url'], '/{')) . '/zipball';
        }

        return view('pages.search', compact('search', 'links'));
    }
}
