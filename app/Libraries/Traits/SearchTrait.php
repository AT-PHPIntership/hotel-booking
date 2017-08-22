<?php

namespace App\Libraries\Traits;

use Illuminate\Support\Facades\Schema;

trait SearchTrait
{
    /**
     * Search the result follow the search request and columns searchableFields.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query of Model
     *
     * @return void.
     */
    public function scopeSearch($query)
    {
        $query->select($this->getTable() . '.*');
        $this->makeJoins($query);
        $keyword = request('search');
        foreach ($this->getColumns() as $value) {
            $query->orWhere($value, "LIKE", "%$keyword%");
        }
    }

    /**
     * Get columns searchableFields
     *
     * @return mixed
     */
    protected function getColumns()
    {
        return array_get($this->searchableFields, 'columns', []);
    }

    /**
     * Get joins
     *
     * @return mixed
     */
    protected function getJoins()
    {
        return array_get($this->searchableFields, 'joins', []);
    }

    /**
     * Make joins
     *
     * @param Builder $query query model
     *
     * @return void
     */
    protected function makeJoins($query)
    {
        foreach ($this->getJoins() as $table => $keys) {
            $query->leftJoin($table, function ($join) use ($keys) {
                $join->on($keys[0], '=', $keys[1]);
            });
        }
    }
}
