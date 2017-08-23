<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    /**
     * Define name table is feedbacks
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;
    
    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
