<?php

namespace App\Http\Controllers;
use App\Models\FeedModel;
use App\Models\CategoryModel;

class FrontController extends Controller
{
    /** renders view of front page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /** calls filter or modal ajax processes
     * @param \Illuminate\Http\Request $request
     */
    public function ajaxProcess(\Illuminate\Http\Request $request)
    {
        if ($request->action == 'processFilter') {
            $this->processFilter($request);
        }

        if ($request->action == 'processModal') {
            $this->processOpenModal($request);
        }
    }

    /** category filter
     * @param $request
     */
    public function processFilter($request)
    {
        $filter_categories = array_map('intval', (array)json_decode($request->filters));
        $feed_ids = FeedModel::getFeedIds($filter_categories);
        $feeds = [];
        if (!empty($feed_ids)) {
            $feeds = FeedModel::getAjaxFeeds($feed_ids);
        } elseif (empty($feed_ids)) {
            $feeds = FeedModel::getFeeds();
        }

        die(view('includes.frontFeeds',
            [
                'feeds' => $feeds
            ]
        )->render()
        );
    }

    /** opens modal with rendered content
     * @param $request
     */
    public function processOpenModal($request)
    {
        $id_feed = (int)$request->id_feed;
        if (!$id_feed) {
            die('0');
        }

        $feed = FeedModel::find($id_feed);
        $link = $feed->link;

        if (!$link) {
            die('0');
        }

        $link_content = file_get_contents($link);

        if (!$link_content) {
            die('0');
        }

        if (preg_match('/<p>(.*)<\/p>/', $link_content, $body)) {
            die(json_encode(
                [
                    'link' => $link,
                    'body' => $body[1]
                ]
            )
        );
        }
    }
}