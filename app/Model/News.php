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
}
