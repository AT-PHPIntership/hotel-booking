<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use SoftDeletes;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'guests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'phone'
    ];

    /**
     * Get all of the guest's reservation.
     *
     * @return array
     */
    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservable', 'target', 'target_id');
    }
}
