<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Sluggable, SoftDeletes;

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
}
