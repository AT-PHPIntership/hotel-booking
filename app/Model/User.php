<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

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
     * Set attribute for user.
     *
     *@param string $userName username of user
     *@param string $password password of user
     *@param string $fullName full_name of user
     *@param string $email    email of user
     *@param string $phone    phone of user
     *@param string $isAdmin  is_admin of user
     *@param string $isActive is_active of user
     *
     * @return void
     */
    public function setAllAttribute(
        $userName,
        $password,
        $fullName,
        $email,
        $phone,
        $isAdmin,
        $isActive
    ) {
        $this->username = $userName;
        $this->email = $email;
        $this->full_name = $fullName;
        $this->is_admin = $isAdmin != null? 1: 0;
        $this->is_active = $isActive != null? 1: 0;
        $this->phone = $phone;

        if (!$password == '') {
            $this->password = bcrypt($password);
        }
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
    }
}
