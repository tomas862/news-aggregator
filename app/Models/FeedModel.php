<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class FeedModel extends Model
{
    protected $table = 'feed';
    
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

    public function getLink()
    {
        $url = $this->link;

        $link_start = '';

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $link_start = "https://";
        }
        return $link_start.$url;
    }

    public static function getFeeds()
    {
        return self::orderBy('updated_at', 'desc')
            ->where('active', 1)
            ->paginate(Config::get('constants.PAGE_COUNT'));
    }

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
