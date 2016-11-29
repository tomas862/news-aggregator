<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedModel extends Model
{
    protected $table = 'feed';

    public function getTitle()
    {
        $url = $this->link;

        $link_start = '';

        if (!strpos($url, "http://")) {
            $link_start = 'http://';
        }

        if (!strpos($url, 'https://')) {
            $link_start = 'https://';
        }

        $read_page=file_get_contents($link_start.$url);
        preg_match("/<title.*?>[\n\r\s]*(.*)[\n\r\s]*<\/title>/", $read_page, $page_title);
        if (isset($page_title[1]))
        {
            if ($page_title[1] == '')
            {
                return $link_start.$url;
            }
            $page_title = $page_title[1];
            return trim($page_title);
        }
        else
        {
            return $link_start.$url;
        }
    }
}
