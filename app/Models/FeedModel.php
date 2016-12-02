<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class FeedModel extends Model
{
    protected $table = 'feed';

    /** gets text in <title></title> tags on given url
     * @return mixed|string
     */
    public function getTitle()
    {
        $url = $this->link;

        $read_page=file_get_contents($url);
        preg_match("/<title.*?>[\n\r\s]*(.*)[\n\r\s]*<\/title>/", $read_page, $page_title);
        if (isset($page_title[1]))
        {
            if ($page_title[1] == '')
            {
                return $url;
            }
            $page_title = $page_title[1];
            return trim($page_title);
        }
        else
        {
            return $url;
        }
    }

    /** get active, ordered feeds with pagination
     * @return mixed
     */
    public static function getFeeds()
    {
        return self::orderBy('updated_at', 'desc')
            ->where('active', 1)
            ->paginate(Config::get('constants.PAGE_COUNT'));
    }

    /** get active, ordered feeds with ajax call
     * @param array $feed_ids
     * @return array
     */
    public static function getAjaxFeeds($feed_ids = [])
    {
        if (empty($feed_ids)) {
            return [];
        }
        return self::orderBy('updated_at', 'desc')
            ->where('active', 1)
            ->whereIn('id', $feed_ids)
            ->paginate(Config::get('constants.PAGE_COUNT'));

    }

    /** get only feed id's
     * @param array $category_ids
     * @return array
     */
    public static function getFeedIds($category_ids = [])
    {
        if (empty($category_ids)) {
            return array();
        }
        return FeedCategoryModel::whereIn('category_model_id', $category_ids)
            ->groupBy('feed_model_id')
            ->pluck('feed_model_id')->toArray();
    }
}
