<?php

namespace App\Http\Controllers;
use App\FeedModel;
use App\CategoryModel;

class FrontController extends Controller
{
    public function index()
    {
        $feeds = FeedModel::orderBy('updated_at', 'desc')->get();
        $categories = CategoryModel::pluck('name', 'id');
        return view(
            'welcome',
            [
                'feeds' => $feeds,
                'categories' => $categories
            ]
        );
    }

    public function ajaxProcessFilter()
    {
        die('response');
    }
}