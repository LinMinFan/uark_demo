@if (Session::has('success'))
    <p class="notice-success">
        {{ Session::get('success') }}
    </p>
@endif

@if (Session::has('error'))
    <p class="notice-error">
        {{ Session::get('error') }}
    </p>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning alert-dismissable">
        {{ Session::get('warning') }}
    </div>
@endif

{{-- 所有錯誤訊息 --}}
@foreach ($errors->all() as $message)
    <p class="notice-error">{{$message}}</p>
@endforeach