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
     *
     * @return object
     */
    public function imageable()
    {
        return $this->morphTo();
    }
    
    /**
     * Insert data into images table and store upload image
     *
     * @param array  $imgs        array of images
     * @param string $target      target to insert images
     * @param int    $targetId    target_id to insert images
     * @param string $folderStore folder to store images
     *
     * @return void
     */
    public static function storeImages($imgs, $target, $targetId, $folderStore)
    {
        foreach ($imgs as $img) {
            $nameImage = config('image.name_prefix') . "-" . $img->hashName();
            $path = $folderStore . $nameImage;
            self::create([
                'target' => $target,
                'target_id' => $targetId,
                'path' => $path
            ]);
            $img->move($folderStore, $nameImage);
        }
    }
}
