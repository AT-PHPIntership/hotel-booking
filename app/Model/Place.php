<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use Sluggable, SoftDeletes;
    
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

    /**
     * Accessor to get path image
     *
     * @param string $image value of image
     *
     * @return string
     */
    public function getImagePathAttribute()
    {
        return config("constant.path_upload_places").$this->image;
    }
}
