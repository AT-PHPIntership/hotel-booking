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
     * Return the category configuration array for this model.
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
