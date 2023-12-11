@if($errors->any())
        <div class="alert alert-danger text-center">
           Vui lòng kiểm tra lại!
        </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@if(Session::has('error'))
        <div class="alert alert-danger text-center">
                {{ Session::get('error') }}
        </div>
@endif

@if(Session::has('success'))
        <div class="alert alert-success text-center">
                {{ Session::get('success') }}
        </div>
@endif