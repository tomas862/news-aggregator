<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedModel extends Model
{
    protected $table = 'feed';

    public function categories()
    {
        return $this->hasMany('App\FeedCategoryModel');
    }
}
