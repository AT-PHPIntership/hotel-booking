<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelService extends Model
{
    use SoftDeletes;

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'hotel_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'hotel_id', 'service_id'
    ];

    /**
     * Relationship with service model
     *
     * @return \App\Model
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
