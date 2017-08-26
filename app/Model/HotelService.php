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
     * Relationship with service model
     *
     * @return \App\Model
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
