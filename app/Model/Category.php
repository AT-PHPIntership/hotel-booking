<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Sluggable, SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];
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
     * Return the category configuration array for this model.
     *
     * @return array
    */
    public function new()
    {
        return $this->hasMany(News::class);
    }
}
