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

        $regex = "((https?|ftp)\:\/\/)?"; // SCHEME
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
        $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
        $regex .= "(\:[0-9]{2,5})?"; // Port
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

        if(!preg_match("/^$regex$/i", $request->feed_url)) // `i` flag for case-insensitive
        {
            return Redirect::back()->withErrors(['Please enter valid url address']);
        }

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
}

