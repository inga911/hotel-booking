<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class RoomPhotos extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;


    public static function add(UploadedFile $gallery, int $room_id)
    {
        $name = $gallery->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/upload/room_photos/';
        $gallery->move($path, $name);
        self::create([
            'room_id' => $room_id,
            'room_photo' => $name
        ]);
    }

    public function deletePhoto()
    {
        $photoPath = public_path() . '/upload/room_photos/' . $this->room_photo;

        if (file_exists($photoPath) && is_file($photoPath)) {
            unlink($photoPath);
        }

        $this->delete();
    }
}
