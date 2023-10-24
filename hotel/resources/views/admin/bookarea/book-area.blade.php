@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="book-area-title">Update Book Area</h1>
    <div class="book-area-container">
        <div class="card-book-area">
            @if (!$book)
                <p>Book area is empty</p>
                <h3>Create new book area</h3>
                <form action="{{ route('admin.book-area-store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $book ? $book->id : '' }}">
                    <div class="label">
                        <label>Short Title</label>
                        <input type="text" name="short_title" value="" />
                    </div>
                    <div class="label">
                        <label>Main Title</label>
                        <input type="text" name="main_title" value="" />
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Short Description</label>
                            <textarea class="form-control" name="short_desc" rows="3" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Link URL</label>
                            <input type="text" name="link_url" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Photo</label>
                            <input class="form-control" name="image" type="file" id="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Save Booking area</button>
                </form>
            @else
                <h3>Update book area</h3>
                <form action="{{ route('admin.book-area-update') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="id" value="{{ $book ? $book->id : '' }}">
                    <div class="label">
                        <label>Short Title</label>
                        <input type="text" name="short_title" value="{{ $book->short_title }}" />
                    </div>
                    <div class="label">
                        <label>Main Title</label>
                        <input type="text" name="main_title" value="{{ $book->main_title }}" />
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Short Description</label>
                            <textarea class="form-control" name="short_desc" rows="3" placeholder="Description">{{ $book->short_desc }}</textarea>
                        </div>
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Link URL</label>
                            <input type="text" name="link_url" class="form-control" value="{{ $book->link_url }}" />
                        </div>
                    </div>
                    <div class="">
                        <div class="label">
                            <label>Photo</label>
                            <input class="form-control" name="image" type="file" id="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Save Booking area</button>
                </form>
            @endif
        </div>
    </div>
@endsection
