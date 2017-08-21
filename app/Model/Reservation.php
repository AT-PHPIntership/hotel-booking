<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    /**
     * Get all of the owning reservable models.
     */
    public function reservable()
    {
        return $this->morphTo();
    }
}
