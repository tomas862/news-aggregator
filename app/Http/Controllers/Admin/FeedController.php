<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class FeedController extends Controller
{
    public function index()
    {
        return view('admin/adminFeedCrud');
    }

    public function addFeedAction(\Illuminate\Http\Request $request)
    {
        if (!$request->has('submit_and_stay_feed') || !$request->has('submit_and_stay_feed')) {
            return Redirect::back();
        }

        if (!$request->feed_url) {
            return Redirect::back()->withErrors(['Please provide valid url address']);
        }

        return redirect('feeds');
    }
}

