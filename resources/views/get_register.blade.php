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
                        <input type="text" class="account form-control"  id="account" placeholder="請填寫帳號" name='account' size="15" value="{{ old('account') }}" required> 
                    </label>
                    <label for="name" class="h6 form-label col-md-5"><span class="required">姓名</span>
                        <input type="text" class="name form-control"  id="name" placeholder="請填寫完整全名" name='name' size="15" value="{{ old('name') }}" required> 
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
                        <select id="org_no"name="org_no" class="form-control" id="org_no">
                            <option value="">請選擇</option>
                            @if (isset($orgs))
                                @foreach ($orgs as $org)
                                    <option value={{$org->org_no}} {{ old('org_no') == $org->org_no ? 'selected' : '' }}>{{$org->title}}</option>
                                @endforeach
                            @endif
                            
                        </select>
                    </label>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOrg">
                        新增單位編號
                    </button>
                </div>
                <div class="form-group">
                    <label class="h6 form-label col-md-6" for="apply_file">
                        上傳檔案
                        <input class="apply_file form-control" type="file" name="apply_file" id="apply_file" accept="image/*,.pdf">
                    </label>
                </div>
                <div class="col-5">
                    <button id="member_register" class="btn btn-success">送出</button>
                    <a href="{{route('get_login')}}" class="btn btn-warning">回登入頁</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createOrg" tabindex="-1" aria-labelledby="createOrgLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createOrgLabel">新增單位編號</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="success-alert" class="alert alert-success col-md-12" style="display: none">
            <strong>新增成功!</strong> <span class="success-message"></span>
        </div>
        <div id="error-alert" class="alert alert-danger col-md-12" style="display: none">
            <strong>新增失敗!</strong> <span class="error-message"></span>
        </div>
        <div class="modal-body">
            <label for="title" class="h6 form-label col-md-5"><span class="required">單位名稱</span>
                <input type="text" class="title form-control"  id="title" placeholder="請填寫單位名稱" size="15"> 
            </label>
            <label for="create_org_no" class="h6 form-label col-md-5"><span class="required">單位編號</span>
                <input type="text" class="create_org_no form-control"  id="create_org_no" placeholder="請填寫單位編號" size="15"> 
            </label>
            <input type="hidden" id="_token" value="{{ csrf_token() }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" id="createOrgSubmit" class="btn btn-primary">新增</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script defer src="{{asset('js/register-checked.js')}}"></script>
    <script defer src="{{asset('js/org-create.js')}}"></script>
@endpush