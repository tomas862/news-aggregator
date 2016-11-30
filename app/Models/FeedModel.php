<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedModel extends Model
{
    protected $table = 'feed';

    public function categories()
    {
        return $this->hasMany('App\Models\FeedCategoryModel');
    }

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
}