<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\FeedModel;
use App\CategoryModel;
use Config;

class FeedController extends Controller
{
    public function index()
    {
        $feedModel = new FeedModel();
        $feeds = $feedModel::paginate(Config::get('constants.ADMIN_PAGE_COUNT'));

        return view(
            'admin/adminFeedCrud',
            [
                'feeds' => $feeds,
                'is_feed' => $feedModel->exists(),
            ]
        );
    }

    public function addFeedAction(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make(
            [
                'feed_url' => $request->feed_url
            ],
            [
                'feed_url' =>
                    'required|max:255'
            ]
        );


    }
}

