<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use Sluggable, SoftDeletes;

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
     * Relationship belongsTo with place
     *
     * @return array
    */
    public function place()
    {
        return $this->belongsTo('App\Model\Place', 'place_id');
    }

    /**
     * Relationship hasMany with rooms
     *
     * @return array
    */
    public function rooms()
    {
        return $this->hasMany('App\Model\Room', 'hotel_id');
    }
}
