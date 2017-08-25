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
     * Define  value status of reservation
     */
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_CANCELED = 3;

    /**
     * Booking room belongs to a Room.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
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
            case self::STATUS_ACCEPTED:
                return __('Accepted');
                break;
            case self::STATUS_REJECTED:
                return __('Rejected');
                break;
            case self::STATUS_CANCELED:
                return __('Canceled');
                break;
            default:
                return __('Pending');
                break;
        }
    }

    /**
     * Get all of the owning reservable models.
     *
     * @return array
     */
    public function reservable()
    {
        return $this->morphTo('reservable', 'target', 'target_id');
    }
}
