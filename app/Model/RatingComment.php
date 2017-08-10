<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RatingComment extends Model
{
    use SoftDeletes;

    const ROW_LIMIT = 10;
    
    /**
     * Relationship with users model
     *
     * @return \App\Model
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    /**
     * Relationship with hotel model
     *
     * @return \App\Model
     */
    public function hotel()
    {
        return $this->belongsTo('App\Model\Hotel', 'hotel_id');
    }
}
