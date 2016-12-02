<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    /** get categories only related to feeds
     * @return mixed
     */
    public static function getFeedCategories()
    {
        return self::join('feed_category', '.category.id', '=', 'feed_category.category_model_id')
            ->pluck('category.name', 'category.id');
    }

    /** get categories by feed id, used in multi selectbox
     * @param $id_feed
     * @return mixed
     */
    public static function getFeedCategoriesByFeedId($id_feed)
    {
        return self::join('feed_category', '.category.id', '=', 'feed_category.category_model_id')
            ->where('feed_category.feed_model_id', (int)$id_feed)
            ->pluck('category.name', 'category.id');
    }
}
