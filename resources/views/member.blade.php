@extends('core.layouts.master')

@push('css')
    
@endpush

@section('content')

@include('partials.notification')

<h1>登入成功</h1>

<a href="{{route('logout')}}" class="btn btn-success">登出</a>

@endsection

@push('js')
    
@endpush