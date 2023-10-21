<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class BookAreaController extends Controller
{
    public function createBookArea()
    {
        $book = BookArea::find(1);
        return view('admin.bookarea.book-area', compact('book'));
    }

    public function bookAreaUpdate(Request $request)
    {
        $book_id = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/bookarea/' . $name);
            $save_url = 'bookarea' . $name;
            BookArea::findOrFail($book_id)->update([

                'short_title' => $request->input('name'),
                'main_title' => $request->input('address'),
                'short_desc' => $request->input('short_desc'),
                'link_url' => $request->input('link_url'),
                'image' => $save_url,
            ]);

            return redirect()->back();
        } else {
            BookArea::findOrFail($book_id)->update([

                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
            ]);
            return redirect()->back();
        }
    }
}
