<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;

     /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name', 'hotel_id', 'descript',
        'price', 'size', 'totel',
        'bed', 'direction', 'max_guest'
    ];

    /**
     * Define a value paginate rows
     */
    const ROW_LIMIT = 10;

    /**
     * Room belongs to a Hotel.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
