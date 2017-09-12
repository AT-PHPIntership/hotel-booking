<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class Hotel extends Model
{
    use Sluggable, SoftDeletes, SearchTrait;

    /**
     * Hotel row limit
     */
    const ROW_LIMIT = 10;

    /**
     * Comment row limit
     */
    const COMMENT_ROW_LIMIT = 5;

    /**
     * Define Max, Min Value Star of Hotel
     */
    const STAR_MAX = 5;
    const STAR_MIN = 1;

    /**
     * Value of low rating score
     */
    const LOW_SCORE = 4.9;

    /**
     * Value of normal rating score
     */
    const NOMAL_SCORE = 6.9;

    /**
     * Value of high rating score
     */
    const HIGH_SCORE = 8.9;

    /**
     * Value of limit round float number
     */
    const LIMIT_ROUND_FLOAT = 1;
    
    /**
     * Value of week number to add week
     */
    const WEEK_NUMBER = 1;

    /**
     * Value of checkin time
     */
    const CHECKIN_TIME = ' 14:00:00';

    /**
     * Value of checkout time
     */
    const CHECKOUT_TIME = ' 11:00:00';

    /**
     * Value of format date time day/month/year hour:minute:second
     */
    const DATETIME_FORMAT = 'd/m/Y H:i:s';

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
     * Get Label for rating comment
     *
     * @return string
     */
    public function getLabelRatingAttribute()
    {
        $rating = $this->ratingComments()->avg('total_rating');
        if ($rating <= self::LOW_SCORE) {
            return __('Bad');
        } elseif (self::LOW_SCORE < $rating && $rating <= self::NOMAL_SCORE) {
            return __('Nomal');
        } elseif (self::NOMAL_SCORE < $rating && $rating <= self::HIGH_SCORE) {
            return __('Good');
        } else {
            return __('Very Good');
        }
    }

    /**
     * Get round avg rating
     *
     * @return float
     */
    public function getRoundAvgRatingAttribute()
    {
        return round($this->ratingComments->avg('total_rating'), self::LIMIT_ROUND_FLOAT);
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
