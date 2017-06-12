<?php

namespace App\Http\Controllers;

use App\Models\BestResult;

class BestResultsController extends Controller
{
    public function index()
    {
        $results = BestResult::all()->sortByDesc('rating')->take(10);

        return view('pages.topRepositories.topRepo', compact('results'));
    }
}
