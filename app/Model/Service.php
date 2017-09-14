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
     * Relationship with hotels
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_services');
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($service) {
            $service->hotelServices()->delete();
        });
    }

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'id',
            'name'
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
