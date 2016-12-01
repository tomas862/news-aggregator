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

    public static function getFeeds($feed_ids = array())
    {
        $query = self::query();
        $query = $query->orderBy('updated_at', 'desc');
        $query = $query->where('active', 1);

        if (!empty($feed_ids)) {
            $query = $query->whereIn('id', $feed_ids);
        }

        $query = $query->paginate(Config::get('constants.PAGE_COUNT'));
        return $query;
    }
}
