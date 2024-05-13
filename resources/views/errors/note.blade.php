{{-- @if(Session::has('error'))
<p class="alert alert-danger ">{{Session::get('error')}}</p>
@endif --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif