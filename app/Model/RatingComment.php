<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RatingComment extends Model
{

    /**
     * Relationship with users model
     *
     * @return \App\Model
     */
    public function users()
    {
        return $this->belongsTo('App\Model\User', 'id');
    }

    /**
     * Relationship with hotel model
     *
     * @return \App\Model
     */
    public function hotels()
    {
        return $this->belongsTo('App\Model\Hotel', 'id');
    }
}
