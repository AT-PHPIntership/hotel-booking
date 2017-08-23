<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class Service extends Model
{
    use SoftDeletes, SearchTrait;

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'id',
            'name',
        ]
    ];
}
