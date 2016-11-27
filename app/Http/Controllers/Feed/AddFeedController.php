<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;

class AddFeedController extends Controller
{
    public function index()
    {
        return view('addFeed');
    }

    public function addFeedAction(\Illuminate\Http\Request $request)
    {
        if (!$request->has('submit_and_stay_feed') || !$request->has('submit_and_stay_feed')) {
            return Redirect::back();
        }

        if (!$request->feed_url) {
            return Redirect::back()->withErrors(['Please provide valid url address']);
        }
    }
}

