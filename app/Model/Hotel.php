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
        return $this->belongsTo(Place::class, 'place_id');
    }

    /**
     * Relationship hasMany with services hotel
     *
     * @return array
    */
    public function hotelServices()
    {
        return $this->hasMany(HotelService::class, 'hotel_id');
    }

    /**
     * Relationship hasMany with rooms
     *
     * @return array
    */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id');
    }

    /**
     * Relationship hasMany with rating comment
     *
     * @return array
    */
    public function ratingComments()
    {
        return $this->hasMany(RatingComment::class, 'hotel_id');
    }

    /**
     * Relationship with hotel's image.
     *
     * @return array
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable', 'target', 'target_id');
    }

    /**
     * This is a recommended way to declare event handlers
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($hotel) {
             $hotel->ratingComments()->delete();
             $hotel->hotelServices()->delete();
             $hotel->rooms()->delete();
             $hotel->images()->delete();
        });
    }
}
