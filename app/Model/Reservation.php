<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class Reservation extends Model
{
    use SoftDeletes, SearchTrait;

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
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'reservations.checkin_date',
            'reservations.checkout_date',
            'rooms.name',
            'rooms.id',
            'hotels.name',
            'hotels.id'
        ],
        'joins' => [
            'rooms' => ['reservations.room_id', 'rooms.id'],
            'hotels' => ['rooms.hotel_id', 'hotels.id']
        ]
    ];

    /**
     * Define a value paginate rows
     */
    const ROW_LIMIT = 10;

    /**
     * Define a value maximum duration
     */
    const MAX_DURATIONS = 15;

    /**
     * Define value target when that user
     */
    const TARGET_USER = 'user';
    
    /**
     * Define value target when that guest
     */
    const TARGET_GUEST= 'guest';

    /**
     * Define  value status of reservation
     */
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_CANCELED = 3;

    /**
     * Available statuses
     *
     * @type array
     */
    public static $availableStatuses = [
        'Pending' => self::STATUS_PENDING,
        'Accepted' => self::STATUS_ACCEPTED,
        'Rejected' => self::STATUS_REJECTED,
        'Canceled' => self::STATUS_CANCELED
    ];

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
