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
}
