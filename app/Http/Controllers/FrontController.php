<?php

namespace App\Http\Controllers;
use App\Models\FeedModel;
use App\Models\CategoryModel;
use App\Models\FeedCategoryModel;
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

    public function ajaxProcessFilter(\Illuminate\Http\Request $request)
    {
        $filters = json_decode($request->filters);

        if (empty($filters)) {
            die('0');
        }

        $feed_ids = FeedCategoryModel::whereIn('category_model_id', $filters)
            ->groupBy('feed_model_id')
            ->pluck('feed_model_id');

        if (empty($feed_ids)) {
            die('0');
        }

        die($feed_ids);
    }
}