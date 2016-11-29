<?php

namespace App\Http\Controllers;
use App\FeedModel;

class FrontController extends Controller
{
    public function index()
    {
        $feeds = FeedModel::orderBy('updated_at', 'desc')->get();
        return view(
            'welcome',
            [
                'feeds' => $feeds
            ]
        );
    }
}