<?php

namespace App\Libraries\Traits;

use Illuminate\Support\Facades\Schema;

trait SearchTrait
{
    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query of Model
     *
     * @return \Illuminate\Database\Eloquent\Builder.
     */
    public function scopeSearch($query)
    {
        $keyword = request('search');
        foreach ($this->searchableFields as $value) {
            $query->orWhere($value, "LIKE", "%$keyword%");      
        }
    }
}
