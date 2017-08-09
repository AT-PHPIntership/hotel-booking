<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use Sluggable, SoftDeletes;
    
    /**
     * Declare table 
     * @var string  
     */
    protected $table = 'places';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'descript', 'image'];

    /**
     * Value paginate of row
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
                'source' => 'name'
            ]
        ];
    }
}
