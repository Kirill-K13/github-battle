<?php

namespace App\Http\Controllers;

use App\Models\BestResult;

class BestResultController extends Controller
{
    public function index()
    {
        $results = BestResult::all()->sortByDesc('rating')->take(10);

        return view('pages.topRepo', compact('results'));
    }
}
