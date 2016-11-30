<?php

namespace App\Http\Controllers;
use App\Models\FeedModel;
use App\Models\CategoryModel;
use Config;

class FrontController extends Controller
{
    public function index()
    {
        $feedsModel = new FeedModel();
        $feeds =
        $feedsModel::orderBy('updated_at', 'desc')->where('active', 1)->paginate(Config::get('constants.PAGE_COUNT'));
        $categories = CategoryModel::pluck('name', 'id');
        return view(
            'welcome',
            [
                'feeds' => $feeds,
                'categories' => $categories,
                'is_feeds' => $feedsModel->exists()
            ]
        );
    }

    public function ajaxProcessFilter()
    {
        die('response');
    }
}