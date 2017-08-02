<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    /*column updated_at won't be set when use timestamp*/
    const UPDATED_AT = null;
}
