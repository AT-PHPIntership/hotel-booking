<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Image;
use App\Libraries\Traits\SearchTrait;

class Room extends Model
{
    use SoftDeletes, SearchTrait;

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;
    
    /**
    * The table associated with the model.
    *
    * @var string $table connect categories table
    */
    protected $table = 'rooms';

    /**
    * Return value of parameter
    *
    * @var array $fillable get value from input tag
    */
    protected $fillable = [
        'name',
        'hotel_id',
        'descript',
        'price',
        'size',
        'total',
        'bed',
        'direction',
        'max_guest',
    ];

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'name',
            'descript',
            'direction',
            'bed',
            'price',
            'max_guest',
            'size',
            'total',
        ]
    ];

    /**
     * Get the room's hotel.
     *
     * @return array
    */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get the room's reservation.
     *
     * @return array
    */
    public function reservations()
    {
        return $this->hasMany('App\Model\Reservation');
    }

    /**
     * Get all of the room's image.
     *
     * @return array
     */
    public function images()
    {
        return $this->morphMany('App\Model\Image', 'imageable', 'target', 'target_id');
    }

    /**
     * Get price format with grouped thousands
     *
     * @return float
     */
    public function getPriceFormatAttribute()
    {
        return number_format($this->price);
    }
    
    /**
     * This is a recommended way to declare event handlers
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($room) {
             $room->images()->delete();
             $room->reservations()->delete();
        });
    }
}
