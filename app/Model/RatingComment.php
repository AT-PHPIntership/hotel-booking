<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class RatingComment extends Model
{
    use SoftDeletes;

    const ROW_LIMIT = 10;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id',
        'user_id',
        'comment',
        'food',
        'cleanliness',
        'comfort',
        'location',
        'service',
        'total_rating'
    ];

    /**
     * Relationship with users model
     *
     * @return \App\Model
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    /**
     * Relationship with hotel model
     *
     * @return \App\Model
     */
    public function hotel()
    {
        return $this->belongsTo('App\Model\Hotel', 'hotel_id');
    }

    /**
     * Get created at format date time string
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->toDayDateTimeString();
    }

    /**
     * Get round of total rating
     *
     * @return float
     */
    public function getRoundTotalRatingAttribute()
    {
        return sprintf(config('hotel.float_fixed_point'), $this->total_rating);
    }
}
