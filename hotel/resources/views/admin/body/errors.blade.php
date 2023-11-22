@if ($errors->any())
    <div class="user-error alert alert-danger">
        <ul class="error-ul">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <div class="user-error alert alert-danger error-ul">
        {{ session('error') }}
    </div>
@endif
