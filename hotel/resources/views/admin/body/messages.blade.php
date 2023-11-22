@if (session('success'))
    <div class="user-success alert alert-success">
        {{ session('success') }}
    </div>
@endif
