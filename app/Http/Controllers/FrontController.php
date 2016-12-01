<?php

namespace App\Http\Controllers;
use App\Models\FeedModel;
use App\Models\CategoryModel;

class FrontController extends Controller
{
    public function index()
    {
        $feeds = FeedModel::getFeeds();
        $categories = CategoryModel::getFeedCategories();
        return view(
            'welcome',
            [
                'feeds' => $feeds,
                'categories' => $categories,
                'feeds_count' => $feeds->count()
            ]
        );
    }

    public function ajaxProcess(\Illuminate\Http\Request $request)
    {
        $filter_categories = array_map('intval', (array)json_decode($request->filters));

        $feed_ids = FeedModel::getFeedIds($filter_categories);
        $feeds = [];
        if (!empty($feed_ids)) {
            $feeds = FeedModel::getAjaxFeeds($feed_ids);
        } elseif (empty($feed_ids)) {
            $feeds = FeedModel::getFeeds();
        }

        die(
            view('frontFeeds',
                [
                    'feeds' => $feeds
                ]
            )->render()
        );
    }
}