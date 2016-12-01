<?php

namespace App\Http\Controllers;
use App\Models\FeedModel;
use App\Models\CategoryModel;
use App\Models\FeedCategoryModel;

class FrontController extends Controller
{
    public function index()
    {
        $feeds = FeedModel::getFeeds();
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

    public function ajaxProcess(\Illuminate\Http\Request $request)
    {
        $filters = array_map('intval', (array)json_decode($request->filters));

        $feed_ids = FeedCategoryModel::whereIn('category_model_id', $filters)
            ->groupBy('feed_model_id')
            ->pluck('feed_model_id')->toArray();

        $feeds = FeedModel::getFeeds($feed_ids);

        die(
            view('frontFeeds',
                [
                    'feeds' => $feeds
                ]
            )->render()
        );
    }
}