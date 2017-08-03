<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    /*define name table is feedbacks*/
    protected $table = 'feedbacks';
    /*column updated_at won't be set when use timestamp*/
    const UPDATED_AT = null;
}
