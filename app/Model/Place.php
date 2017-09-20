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
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'name',
            'descript',
            'id'
        ]
    ];

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;
    
    /**
     * Value row's show of home page
     */
    const SHOW_HOME_LIMIT = 7 ;


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
    
    /**
     * Get top 7 place booked most within the last month
     *
     * @return array
     */
    public static function topPlaces()
    {
            return \DB::table('places')->select('places.id', 'places.name', 'places.slug', \DB::raw("SUM(quantityReservations) AS totalQuantity"))
                                ->leftJoin('hotels', 'hotels.place_id', '=', 'places.id')
                                ->leftJoin('rooms', 'rooms.hotel_id', '=', 'hotels.id')
                                ->leftJoin(\DB::raw('(SELECT reservations.room_id , SUM(quantity) as quantityReservations FROM reservations where reservations.created_at <= DATE_SUB(NOW(),INTERVAL -30 DAY) GROUP BY reservations.room_id) AS reservation_of_rooms'), 'rooms.id', '=', 'reservation_of_rooms.room_id')
                                ->groupBy('places.id')
                                ->orderby('totalQuantity', 'DESC')
                                ->limit(7)
                                ->get();
    }
}
