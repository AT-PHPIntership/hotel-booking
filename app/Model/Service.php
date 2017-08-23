<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;

    /**
     * Get hotel service for service
     *
     * @return array
     */
    public function hotelServices()
    {
        return $this->hasMany(HotelService::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($service) {
            $service->hotelServices()->delete();
        });
    }
}
