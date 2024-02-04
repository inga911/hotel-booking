@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Message request
    </h1>
    <div class="card">
        @php
            $currentPage = request('page', 1);
            $perPage = $sortMessages->perPage();
            $startingIndex = ($currentPage - 1) * $perPage;
        @endphp

        <form action="{{ route('admin.request-message') }}" method="GET">
            <label for="sort">Sort messages by:</label>
            <select name="sort" onchange="this.form.submit()">
                @foreach (\App\Models\Contact::SORT as $key => $value)
                    <option value="{{ $key }}" {{ request('sort') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Received</th>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sortMessages as $key => $item)
                            <tr>
                                <td>{{ $startingIndex + $key + 1 }}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->message }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.delete-message', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-div">{{ $sortMessages->appends(request()->input())->links() }}</div>

        </div>
    </div>
@endsection
