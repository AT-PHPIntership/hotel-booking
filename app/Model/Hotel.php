<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Libraries\Traits\SearchTrait;
use Carbon\Carbon;
use DB;

class Hotel extends Model
{
    use Sluggable, SoftDeletes, SearchTrait;

    const ROW_LIMIT = 10;
    const ITEM_LIMIT = 12;

    /**
     * Define Max, Min Value Star of Hotel
     */
    const STAR_MAX = 5;
    const STAR_MIN = 1;

    /**
     * Define kind arrange_id
     *
     * @type int
     */
    const PRICE_ASC = 1;
    const PRICE_DESC = 2;
    const STAR_ASC = 3;
    const STAR_DESC = 4;
    const RATING_DESC = 5;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'hotels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'id', 'name', 'address', 'star', 'introduce', 'place_id'
    ];

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
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'hotels.name',
            'hotels.address',
            'places.name',
            'hotels.star'
        ],
        'joins' => [
            'places' => ['places.id', 'hotels.place_id'],
            'rooms' => ['hotels.id', 'rooms.hotel_id']
        ]
    ];

    /**
     * Relationship belongsTo with place
     *
     * @return array
    */
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    /**
     * Relationship hasMany with services hotel
     *
     * @return array
    */
    public function hotelServices()
    {
        return $this->hasMany(HotelService::class, 'hotel_id');
    }

    /**
     * Relationship hasMany with rooms
     *
     * @return array
    */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id');
    }

    /**
     * Relationship hasMany with rating comment
     *
     * @return array
    */
    public function ratingComments()
    {
        return $this->hasMany(RatingComment::class, 'hotel_id');
    }

    /**
     * Relationship with hotel's image.
     *
     * @return array
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable', 'target', 'target_id');
    }

    /**
     * This is a recommended way to declare event handlers
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($hotel) {
             $hotel->ratingComments()->delete();
             $hotel->hotelServices()->delete();
             $hotel->rooms()->delete();
             $hotel->images()->delete();
        });
    }

    /**
     * Scope query after check place of hotels
     *
     * @param queryBuilder       $query   query to change
     * @param SearchHotelRequest $request request to display
     *
     * @return queryBuilder
     */
    public function scopePlaceCondition($query, $request)
    {
        if ($request->has('hotelSourceArea')) {
            // Hotel belong to searched place
            $place = Place::where("name", "$request->hotelSourceArea")->first();
            return $query->where("hotels.place_id", $place->id);
        }
        return $query;
    }


    /**
     * Scope query after check arrange of hotels
     *
     * @param queryBuilder       $query   query to change
     * @param SearchHotelRequest $request request to display
     *
     * @return queryBuilder
     */
    public function scopeOrderCondition($query, $request)
    {
        if ($request->has('arrange_id')) {
            // Arrange hotel
            switch ($request->arrange_id) {
                case Hotel::PRICE_ASC:
                    // Arrange hotel by most cheap room in hotels order by increase
                    return $query->join(DB::raw("(SELECT hotel_id, min(price) AS min_price_room FROM rooms group by hotel_id) AS most_cheap_rooms"), 'most_cheap_rooms.hotel_id', '=', 'hotels.id')
                                ->orderby('min_price_room', 'ASC');
                case Hotel::PRICE_DESC:
                   // Arrange hotel by most expensive room in hotels order by decrease
                    return $query->join(DB::raw("(SELECT hotel_id, max(price) AS max_price_room FROM rooms group by hotel_id) AS most_expensive_rooms"), 'most_expensive_rooms.hotel_id', '=', 'hotels.id')
                                ->orderby('max_price_room', 'DESC');
                case Hotel::STAR_ASC:
                    // Arrange hotel by star of hotel order by increase
                    return $query->orderby('star', 'ASC');
                case Hotel::STAR_DESC:
                    // Arrange hotel by star of hotel order by increase
                    return $query->orderby('star', 'DESC');
                case Hotel::RATING_DESC:
                    // Arrange hotel by average rating of hotel order by decrease
                    return $query->join(DB::raw("(SELECT hotel_id, avg(total_rating) AS avg_rating FROM rating_comments group by hotel_id) AS summary_ratings"), 'summary_ratings.hotel_id', '=', 'hotels.id')
                                ->orderby('avg_rating', 'DESC');
            }
        }
        return $query;
    }

    /**
     * Scope query after check checkin blank rooms of hotels
     *
     * @param queryBuilder       $query   query to change
     * @param SearchHotelRequest $request request to display
     * @param array              $columns array of columns
     *
     * @return queryBuilder
     */
    public function scopeCheckinCondition($query, $request, $columns)
    {
        if ($request->has('checkin')) {
            $checkin = Carbon::createFromFormat(config('showitem.format_datetime'), $request->checkin . " " . config('showitem.checkin_time'))
                        ->toDateTimeString();

            $checkout = Carbon::createFromFormat(config('showitem.format_datetime'), $request->checkin . " " . config('showitem.checkout_time'))
                        ->addDay($request->duration)
                        ->toDateTimeString();
            // Hotel have blank room from checkin day to checkout day
            return $query->join('rooms', 'rooms.hotel_id', '=', 'hotels.id')
                        ->leftJoin(DB::raw("(SELECT room_id, SUM(quantity) as quantity_busy_reservation FROM reservations WHERE (status = ?) AND ((checkin_date < ? AND checkout_date > ?) OR (checkin_date < ? AND checkout_date > ?)) GROUP BY room_id)  AS busy_rooms"), 'busy_rooms.room_id', '=', 'rooms.id')
                        ->addBinding([
                            Reservation::STATUS_ACCEPTED,
                            $checkin,
                            $checkin,
                            $checkout,
                            $checkout
                        ], 'join')
                        ->where(DB::raw('COALESCE(quantity_busy_reservation, 0)'), '<', DB::raw('CONVERT(total, CHAR(5))'))
                        ->select(array_merge($columns, [DB::raw("COUNT(rooms.id) AS quantity_kind_blank_room")]))
                        ->groupBy('hotels.id');
        }
        return $query;
    }
}
