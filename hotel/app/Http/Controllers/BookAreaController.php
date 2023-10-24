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

    public function storeBookArea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'short_title' => 'required',
            'main_title' => 'required',
            'short_desc' => 'required',
            'link_url' => 'required',
            'image' => 'sometimes|required|image|max:512',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/bookarea/' . $name);
            $name =  $name;
        }

        BookArea::create([
            'short_title' => $request->input('short_title'),
            'main_title' => $request->input('main_title'),
            'short_desc' => $request->input('short_desc'),
            'link_url' => $request->input('link_url'),
            'image' => $name,
        ]);

        return redirect()->route('admin.book-area');
    }

    public function bookAreaUpdate(Request $request)
    {
        $book_id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'short_title' => 'required',
            'main_title' => 'required',
            'short_desc' => 'required',
            'link_url' => 'required',
            'image' => 'sometimes|image|max:512',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $book = BookArea::findOrFail($book_id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 1000)->save('upload/bookarea/' . $name);
            $name = 'bookarea/' . $name;
            $book->image = $name;
        }

        $book->short_title = $request->input('short_title');
        $book->main_title = $request->input('main_title');
        $book->short_desc = $request->input('short_desc');
        $book->link_url = $request->input('link_url');
        $book->save();

        return redirect()->route('admin.book-area');
    }
}
