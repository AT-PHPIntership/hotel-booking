<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class News extends Model
{
    use Sluggable, SoftDeletes, SearchTrait;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'title', 'content', 'category_id'
    ];

     /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'news.title',
            'news.content',
            'news.category_id',
            'categories.name'
        ],
        'joins' => [
            'categories' => ['news.category_id', 'categories.id']
        ]
    ];

    /**
     * Define a value paginate rows
     */
    const ROW_LIMIT = 10;

    /**
     * Define a value show item
     */
    const ITEM_LIMIT = 4;

    /**
     * Define a value number top news
     */
    const TOP_NEWS = 5;

    /**
     * Define a value paginate rows follow category
     */
    const ITEM_PER_PAGE = 12;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    /**
     * News belongs to a Category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relationship with news's image
     *
     * @return array
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable', 'target', 'target_id');
    }
}
