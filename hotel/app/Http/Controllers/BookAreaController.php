<?php

namespace App\Http\Controllers;

use App\Models\BookArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BookAreaController extends Controller
{
    public function createBookArea()
    {
        $book = BookArea::first();
        return view('admin.bookarea.book-area', compact('book'));
    }

    public function storeBookArea(Request $request, BookArea $book)
    {
        $validator = Validator::make($request->all(), [
            'short_title' => 'required',
            'main_title' => 'required',
            'short_desc' => 'required',
            'link_url' => 'required',
            'image' => 'sometimes|required|image|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $image = $request->image;
        if ($image) {
            $name = $book->savePhoto($image);
        }


        BookArea::create([
            'short_title' => $request->short_title,
            'main_title' => $request->main_title,
            'short_desc' => $request->short_desc,
            'link_url' => $request->link_url,
            'image' => $name ?? null,
        ]);

        return redirect()->route('admin.book-area');
    }


    public function bookAreaUpdate(Request $request, BookArea $book)
    {
        $book_id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'short_title' => 'required',
            'main_title' => 'required',
            'short_desc' => 'required',
            'link_url' => 'required',
            'image' => 'sometimes|image|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $book = BookArea::findOrFail($book_id);

        $image = $request->image;
        if ($image) {
            $name = $book->savePhoto($image);
        } else {
            $name = $book->image;
        }

        $book->update([
            'short_title' => $request->short_title,
            'main_title' => $request->main_title,
            'short_desc' => $request->short_desc,
            'link_url' => $request->link_url,
            'image' => $name,
        ]);

        return redirect()->back();
    }
}
