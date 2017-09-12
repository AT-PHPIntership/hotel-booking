<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class Hotel extends Model
{
    use Sluggable, SoftDeletes, SearchTrait;

    const ROW_LIMIT = 10;
    const ITEM_LIMIT = 12;

    /**
     * Define Max, Min Value Star of Hotel
     */
    const STAR_MAX = 5;
    const STAR_MIN = 1;

    /**
     * Define kind arrange_id
     *
     * @type int
     */
    const PRICE_ASC = 1;
    const PRICE_DESC = 2;
    const STAR_ASC = 3;
    const STAR_DESC = 4;
    const RATING_DESC = 5;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'hotels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'id', 'name', 'address', 'star', 'introduce', 'place_id'
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
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'hotels.name',
            'hotels.address',
            'places.name',
            'hotels.star'
        ],
        'joins' => [
            'places' => ['places.id', 'hotels.place_id'],
            'rooms' => ['hotels.id', 'rooms.hotel_id']
        ]
    ];

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
