@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="error-ul user-error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger error-ul user-error">
        {{ session('error') }}
    </div>
@endif
