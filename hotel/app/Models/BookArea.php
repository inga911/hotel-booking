<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class BookArea extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function savePhoto(UploadedFile $image): string
    {
        $name = $image->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/upload/bookarea/';
        $image->move($path, $name);
        $img = Image::make($path . $name);
        $img->resize(1000, 1000);
        $img->save($path . 't_' . $name, 90);
        return $name;
    }
}
