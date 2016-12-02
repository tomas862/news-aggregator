<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\FeedModel;
use App\Models\FeedCategoryModel;
use Session;
use Config;
use Route;

class FeedController extends Controller
{
    /** renders view of admin feeds CRUD
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $feedModel = new FeedModel();
        $inactive_feeds = $feedModel::where('active', 0)->count();
        $feeds = $feedModel::paginate(Config::get('constants.PAGE_COUNT'));

        return view(
            'admin/adminFeedCrud',
            [
                'feeds' => $feeds,
                'is_feed' => $feedModel->exists(),
                'inactive_feeds_count' => $inactive_feeds
            ]
        );
    }

    /** renders view of admin add feed form
     * @param int $id_feed
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addFeedView($id_feed = 0)
    {
        $link = '';
        $selected_categories = [];

        if ($id_feed) {
            $feedModel = FeedModel::find($id_feed);
            $link = $feedModel->link;
            $selected_categories = CategoryModel::getFeedCategoriesByFeedId($id_feed);
        }

        $categories = CategoryModel::pluck('name', 'id')->all();
        return view(
            'admin/addFeed',
            [
                'feed_link' => $link,
                'categories' => $categories,
                'selected_categories' => $selected_categories,
                'id_feed' => $id_feed
            ]
        );
    }

    /** validates feed url
     * @param \Illuminate\Http\Request $request
     * @return Redirect
     */
    public function addFeedAction(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make(
            [
                'feed_url' => $request->feed_url
            ],
            [
                'feed_url' =>
                'required|regex:/^(https?:)?\/\/[$~:;#,%&_=\(\)\[\]\.\? \+\-@\/a-zA-Z0-9]+$/|max:255'
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if ($request->id_feed) {
            $this->updateFeed($request->id_feed, $request);
        } elseif (!$request->id_feed) {
            $this->addFeed($request);
        }

        Session::flash('success_message', Config::get('constants.SUCCESS_COMMIT'));

        if ($request->has('submit_and_stay_feed')) {
            return Redirect::back();
        }

        return Redirect('/feeds');
    }

    /** adds new feed to feed table
     * @param $request
     */
    public function addFeed($request)
    {
        DB::beginTransaction();

        $feedModel = new FeedModel();
        $feedModel->link = $request->feed_url;
        $feedModel->active = 0;
        $feedModel->save();

        if (!empty($request->categories)) {
            foreach ($request->categories as $category) {
                $categoryModel = new FeedCategoryModel();
                $categoryModel->feed_model_id = $feedModel->id;
                $categoryModel->category_model_id = $category;
                $categoryModel->save();
            }
        }
        DB::commit();
    }

    /** updates existing feeds
     * @param $id_feed
     * @param $request
     */
    public function updateFeed($id_feed, $request)
    {
        $feedModel = FeedModel::find($id_feed);
        $feedModel->link = $request->feed_url;
        $feedModel->active = 0;
        $feedModel->update();

        $categoryModel = FeedCategoryModel::where('feed_model_id', $id_feed)->delete();
        if (!empty($request->categories)) {
            foreach ($request->categories as $category) {
                $categoryModel = new FeedCategoryModel();
                $categoryModel->feed_model_id = $id_feed;
                $categoryModel->category_model_id = $category;
                $categoryModel->save();
            }
        }
    }

    /** removes categories from feeds table and from feed_category table
     * @return Redirect
     */
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

        if (!$feedModel->delete()) {
            return Redirect::back()->withErrors(['Failed to delete feed']);
        }

        return Redirect('/feeds');
    }
}

