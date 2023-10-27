@extends('admin.admin-dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @if (!$book)
        <h1 class="admin-main-title">
            <i class='bx bxs-chevron-right'></i>
            Create new booking area
        </h1>
        <div class="book-area-container">
            <form action="{{ route('admin.book-area-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $book ? $book->id : '' }}">
                <table class="book-area-table">
                    <tbody>
                        <tr>
                            <td class="book-label">Short Title:</td>
                            <td><input type="text" id="short_title" name="short_title" value="" /></td>
                        </tr>
                        <tr>
                            <td class="book-label">Main Title:</td>
                            <td><input type="text" id="main_title" name="main_title" value="" />
                            </td>
                        </tr>
                        <tr>
                            <td class="book-label">Short Description:</td>
                            <td>
                                <textarea class="form-control" id="short_desc" name="short_desc" rows="3" placeholder="Description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="book-label">Link URL:</td>
                            <td><input type="text" id="link_url" name="link_url" class="form-control" value="" />
                            </td>
                        </tr>
                        <tr class="book-area-photo">
                            <td class="book-label">Photo:</td>
                            <td>
                                <input class="form-control" id="image" name="image" type="file">
                                <img id="showImage"
                                    src="{{ !empty($book->image) ? url('upload/bookarea/' . $book->image) : url('upload/noimage.jpg') }}"
                                    class="main-review-img" alt="existing booking photo" width="80">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-danger">Save Booking area</button>
            </form>
        </div>
    @else
        <h1 class="admin-main-title">
            <i class='bx bxs-chevron-right'></i>
            Update new book area
        </h1>
        <div class="book-area-container">
            <div class="card-book-area">
                <form action="{{ route('admin.book-area-update') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="id" value="{{ $book ? $book->id : '' }}">
                    <table class="book-area-table">
                        <tbody>
                            <tr>
                                <td class="book-label">Short Title:</td>
                                <td><input type="text" id="short_title" name="short_title"
                                        value="{{ $book->short_title }}"></td>
                            </tr>
                            <tr>
                                <td class="book-label">Main Title:</td>
                                <td><input type="text" id="main_title" name="main_title"
                                        value="{{ $book->main_title }}" />
                                </td>
                            </tr>
                            <tr>
                                <td class="book-label">Short Description:</td>
                                <td>
                                    <textarea class="form-control" name="short_desc" id="short_desc" rows="3" placeholder="Description">{{ $book->short_desc }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="book-label">Link URL:</td>
                                <td><input type="text" name="link_url" class="form-control"
                                        value="{{ $book->link_url }}" />
                                </td>
                            </tr>
                            <tr class="book-area-photo">
                                <td class="book-label">Photo:</td>
                                <td>
                                    <input class="form-control" name="image" id="image" type="file" id="image">
                                    <img id="showImage"
                                        src="{{ !empty($book->image) ? url('upload/bookarea/' . $book->image) : url('upload/noimage.jpg') }}"
                                        class="main-review-img" alt="existing booking photo" width="80">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-danger">Update Booking area</button>
                </form>
            </div>
        </div>
    @endif


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
