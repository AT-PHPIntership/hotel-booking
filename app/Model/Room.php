<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Model\Image;

class Room extends Model
{
    use SoftDeletes;

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
     * Return the news configuration array for this model.
     *
     * @return array
    */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
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
}
