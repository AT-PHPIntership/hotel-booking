<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class Category extends Model
{
    use Sluggable, SoftDeletes, SearchTrait;

    /**
    * The table associated with the model.
    *
    * @var string $table connect categories table
    */
    protected $table = 'categories';

    /**
    * Return value of parameter
    *
    * @var array $fillable get value from input tag
    */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'categories.name',
        ],
        
    ];

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;

    /**
     * Define a value show item
     */
    const ITEM_LIMIT = 3;
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /**
     * Return the news configuration array for this model.
     *
     * @return array
    */
    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * Return the category configuration array for this model.
     *
     * @return array
    */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->news()->delete();
        });
    }
}
