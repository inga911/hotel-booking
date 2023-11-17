<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Testimonials;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestimonialsController extends Controller
{

    public function index()
    {
        //
    }


    public function createTestimonials()
    {
        $roomTypes = RoomType::all();
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.testimonials.testimonials-create', [
            'roomTypes' => $roomTypes,
            'user' => $user,
        ]);
    }


    public function storeTestimonials(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required',
            'author_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        Testimonials::create([
            'review' => $request->review,
            'author_name' => $request->author_name,
        ]);
        return redirect()->back();
    }


    public function show(Testimonials $testimonials)
    {
        //
    }

    public function edit(Testimonials $testimonials)
    {
        //
    }


    public function update(Request $request, Testimonials $testimonials)
    {
        //
    }


    public function destroy(Testimonials $testimonials)
    {
        //
    }
}
