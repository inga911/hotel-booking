@extends('admin.admin-dashboard')
@section('admin')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        Message request
    </h1>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Received</th>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contact as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->message }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
