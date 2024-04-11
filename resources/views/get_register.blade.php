@extends('core.layouts.master')

@push('css')
    
@endpush

@section('content')

<div class="container">
    <div class="row" id="content">
        <h2 class="col-12">會員註冊</h2>

        @include('partials.notification')

    </div>
    <div class="form-wrap">
        <div class="row">
            <form class="member_register col-md-12" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="account" class="h6 form-label col-md-5"><span class="required">帳號</span>
                        <input type="text" class="account form-control"  id="account" placeholder="請填寫帳號" name='account' size="15" maxlength="20" value="{{ old('account') }}" required> 
                    </label>
                    <label for="name" class="h6 form-label col-md-5"><span class="required">姓名</span>
                        <input type="text" class="name form-control"  id="name" placeholder="請填寫完整全名" name='name' size="15" maxlength="20" value="{{ old('name') }}" required> 
                    </label>
                </div>
                <div class="form-group">
                    <label for="password" class="h6 form-label col-md-5"><span class="required">密碼</span>
                        <input type="password" class="password form-control"  id="password" placeholder="請輸入密碼" name='password' value="" required> 
                    </label>
                    <label for="birthday" class="h6 form-label col-md-5"><span>出生日期</span>
                        <input type="date" class="birthday form-control" id="birthday" name='birthday' value="{{ old('birthday')?? '' }}">
                    </label>
                </div>
                <div class="form-group">
                    <label for="email" class="h6 form-label col-md-10">
                        <span class="required ">Email</span>
                        <input type="text" class="email form-control" placeholder="example@gmail.com" id="email" name='email' value="{{ old('email') }}" placeholder="example@gmail.com" required>
                    </label>
                </div>
                <div class="form-group">
                    <label for="org_no" class="h6 form-label col-md-6"><span class="required">單位號碼</span>
                        <input type="text" class="org_no form-control"  id="org_no" placeholder="請填寫單位號碼" name='org_no' value="{{ old('org_no') }}" required> 
                    </label>
                    <button id="org_no_check" class="btn btn-primary">單位號碼確認</button>
                </div>
                <div class="form-group">
                    <label class="h6 form-label col-md-6" for="apply_file">
                        上傳檔案
                        <input class="apply_file form-control" type="file" name="apply_file" id="apply_file" accept="image/*,.pdf">
                    </label>
                </div>
                <div class="col-5">
                    <button id="member_register" class="btn btn-success">送出</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script defer src="{{asset('js/register-checked.js')}}"></script>
@endpush