<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use Sluggable;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = null;

     /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;
    
    /**
    * The table associated with the model.
    *
    * @var string $table connect categories table
    */
    protected $table = 'static_pages';

    /**
    * Return value of parameter
    *
    * @var array $fillable get value from input tag
    */
    protected $fillable = [
        'title',
        'content'
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
                'source' => 'title'
            ]
        ];
    }
}
