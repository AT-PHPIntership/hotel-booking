<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RatingComment extends Model
{
    use SoftDeletes;

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
