<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\FeedModel;
use App\FeedCategoryModel;
use Session;
use Config;
use Route;

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
                    'required|unique:feed,link,:link|max:255'
            ]
        );

        DB::beginTransaction();

        $feedModel = new FeedModel();
        $feedModel->link = $request->feed_url;
        $feedModel->active = 0;
        $feedModel->save();

        if (!empty($request->categories)) {
            foreach ($request->categories as $category) {
                $categoryModel = new FeedCategoryModel();
                $categoryModel->feed_id = $feedModel->id;
                $categoryModel->category_id = $category;
                $categoryModel->save();
            }
        }
        DB::commit();

        Session::flash('success_message', Config::get('constants.SUCCESS_COMMIT'));

        if ($request->has('submit_and_stay_feed')) {
            return Redirect::back();
        }

        return Redirect('/feeds');
    }

    public function removeFeedAction()
    {
        $id_feed = (int)Route::current()->getParameter('id');

        if (!$id_feed) {
            return Redirect::back()->withErrors(['No feed provided']);
        }

        $feedModel = FeedModel::find($id_feed);

        if (!$feedModel) {
            return Redirect::back()->withErrors(['Unable to find feed']);
        }

        FeedCategoryModel::where('feed_id', $id_feed)->delete();

        if (!$feedModel->delete()) {
            return Redirect::back()->withErrors(['Failed to delete feed']);
        }

        return Redirect('/feeds');
    }
}

