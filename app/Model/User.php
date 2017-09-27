<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Traits\SearchTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use SoftDeletes, SearchTrait, AuthenticableTrait;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'full_name', 'password', 'email', 'phone', 'is_admin', 'is_active'
     ];

    /**
     * The attributes that can be search.
     *
     * @var array $searchableFields
     */
    protected $searchableFields = [
        'columns' => [
            'users.username',
            'users.full_name',
            'users.email',
            'users.phone'
        ]
    ];

    /**
     * Value paginate of row
     */
    const ROW_LIMIT = 10;

    /**
     * Value of admin
     */
    const ROLE_ADMIN = 1;

    /**
     * Value of user
     */
    const ROLE_USER = 0;

    /**
     * Value of actived user
     */
    const STATUS_ACTIVED = 1;

    /**
     * Value of disabled user
     */
    const STATUS_DISABLED = 0;

    /**
     * Value of timeout & key cache bookingInfomation
     */
    const TIMEOUT_CACHE = 60;
    const KEY_CACHE = 'bookingInfomation';

    /**
     * Default value cache bookingInfomation
     */
    const DEFAULT_VALUE = null;

    /**
     * Get all of the user's ratingcomment.
     *
     * @return array
     */
    public function ratingComments()
    {
        return $this->hasMany('App\Model\RatingComment');
    }

    /**
     * Get all of the user's reservation.
     *
     * @return array
     */
    public function reservations()
    {
        return $this->morphMany('App\Model\Reservation', 'reservable', 'target', 'target_id');
    }

     /**
     * Get all of the user's image.
     *
     * @return array
     */
    public function images()
    {
        return $this->morphMany('App\Model\Image', 'imageable', 'target', 'target_id');
    }

    /**
     * This is a recommended way to declare event handlers
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
             $user->ratingComments()->delete();
             $user->reservations()->delete();
        });

        static::saving(function ($user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = bcrypt($user->password);
            }
        });
    }

    /**
     * Get role from user
     *
     * @return string of role
     */
    public function getRoleAttribute()
    {
        return $this->is_admin == self::ROLE_ADMIN? __('Admin'): __('User');
    }

    /**
     * Get status from user
     *
     * @return string of status
     */
    public function getStatusAttribute()
    {
        return $this->is_active == self::STATUS_ACTIVED? __('Actived'): __('Disabled');
    }
}
