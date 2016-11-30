<?php

namespace App\Http\Controllers;
use App\Models\FeedModel;
use App\Models\CategoryModel;
use Config;

class FrontController extends Controller
{
    public function index()
    {
        $feeds =
            FeedModel::orderBy('updated_at', 'desc')->where('active', 1)->paginate(Config::get('constants.PAGE_COUNT'));
        $categories = CategoryModel::join('feed_category', '.category.id', '=', 'feed_category.category_model_id')
                        ->pluck('category.name', 'category.id');
        return view(
            'welcome',
            [
                'feeds' => $feeds,
                'categories' => $categories,
                'feeds_count' => $feeds->count()
            ]
        );
    }

    public function ajaxProcessFilter()
    {
        die('response');
    }
}