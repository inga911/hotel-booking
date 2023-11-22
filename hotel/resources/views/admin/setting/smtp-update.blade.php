@extends('admin.admin-dashboard')
@section('admin')
    @include('admin.body.errors')
    @include('admin.body.messages')
    <h1 class="admin-main-title">
        <i class='bx bxs-chevron-right'></i>
        SMTP Setting
    </h1>

    <div class="card">

        <form action="{{ route('admin.smtp-update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="">
            <input type="hidden" name="id" value="{{ $smtp->id }}">

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0"> Mailer </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="mailer" class="form-control" value="{{ $smtp->mailer }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Host</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="host" class="form-control" value="{{ $smtp->host }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Port</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="port" class="form-control" value="{{ $smtp->port }}" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="username" class="form-control" value="{{ $smtp->username }}" />
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="password" class="form-control" value="{{ $smtp->password }}" />
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Encryption</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="encryption" class="form-control" value="{{ $smtp->encryption }}" />
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0"> From Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" name="from_address" class="form-control" value="{{ $smtp->from_address }}" />
                    </div>
                </div>




                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
