<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var string $fillable
     */
    protected $fillable = [
            'target', 'target_id', 'path'
    ];

     /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
