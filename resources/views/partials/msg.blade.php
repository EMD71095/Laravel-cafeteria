@if(session()->has('success'))
    <div class="alert alert-success text-center">
        <p>{{ session('success') }}</p>
    </div>
@endif
