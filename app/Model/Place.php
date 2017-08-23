<?php
namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;

class Place extends Model
{
     use Sluggable, SoftDeletes, SearchTrait;
    
    /**
     * Declare table
     *
     * @var string
     */
    protected $table = 'places';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'descript', 'image'];

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Accessor to get path image
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return asset(config("image.places.path_upload") . $this->image);
    }

    /**
     * Get hotels for place
     *
     * @return array
     */
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($place) {
            $place->hotels()->delete();
        });
    }
}
