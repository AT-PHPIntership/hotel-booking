<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Image;

class ImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id of image
     *
     * @return array
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        return ['result' => $image->delete()];
    }
}
