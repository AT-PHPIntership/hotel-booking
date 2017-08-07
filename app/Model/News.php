<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use Sluggable, SoftDeletes;

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
     * Return the sluggable configuration array for this model.
     *
     * @return array
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
