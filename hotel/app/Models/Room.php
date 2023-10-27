<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoomType;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'facility_id');
    }

    public function roomPhotos()
    {
        return $this->hasMany(RoomPhotos::class, 'room_photo_id');
    }

    public function savePhoto(UploadedFile $photo): string
    {
        $name = $photo->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/upload/room_photos/';
        $photo->move($path, $name);
        $img = Image::make($path . $name);
        $img->resize(1000, 1000);
        $img->save($path . 't_' . $name, 90);
        return $name;
    }

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/upload/room_photos/' . $this->photo;
            unlink($photo);
            $photo = public_path() . '//upload/room_photos/t_' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }
}
