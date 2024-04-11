@extends('core.layouts.master')

@push('css')
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
@endpush

@section('content')

<section id="login">
    <div class="container">
        @include('partials.notification')
    	<div class="row">
    	    <div class="col-12">
        	    <div class="form-wrap">
                <h1>使用者登入頁</h1>
                    <form role="form" action="login" method="post" id="login-form" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="account" class="sr-only">帳號</label>
                            <input type="account" name="account" id="account" class="form-control" placeholder="帳號" required>
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">密碼</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="密碼" required>
                        </div>
                        <span class="label">顯示密碼</span>
                        <input class="checkbox character-checkbox" type="checkbox" onclick="showPassword()">
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="登入">
                    </form>
                    <a href="{{route('get_register')}}" class="register">建立使用者帳號</a>
                    <hr>
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

@endsection

@push('js')
    <script defer src="{{asset('js/login.js')}}"></script>
@endpush