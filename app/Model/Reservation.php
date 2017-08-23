<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'status',
        'room_id',
        'target',
        'target_id',
        'request',
        'quantity',
        'checkin_date',
        'checkout_date'
    ];

    /**
     * Define a value paginate rows
     */
    const ROW_LIMIT = 10;
    
    /**
     * Booking room belongs to a Room.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingroom()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get status of a reservation.
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->attributes['status']) {
            case '1':
                return __('Accept');
                break;
            case '2':
                return __('Reject');
                break;
            case '3':
                return __('Cancel');
            default:
                return __('Pending');
                break;
        }
    }

    /**
     * Get all of the owning reservable models.
     */
    public function reservabl()
    {
        return $this->morphTo();
    }
}
