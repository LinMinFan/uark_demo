<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Org;
use App\Models\ApplyFile;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    
    public function postLogin (LoginRequest $request)
    {

        $attempt = false;

        $credentials = [
            'account' => $request->account,
            'password' => $request->password,
        ];

        try {
            $attempt = Auth::attempt($credentials);
            $message = '帳號或密碼錯誤';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        if (!$attempt) {
            return redirect()->back()->with('error',$message);
        } else {
            $user = Auth::user();
            $route = ($user->status == 0) ? 'review' : 'member' ;
            return redirect()->route($route)->withSuccess('登入成功');
        }
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('get_login');
    }

    public function getCheckStatus()
    {
        $user = Auth::user();

        if ($user->status == 0) {
            return view('account_review');
        }else {
            return view('member');
        }
    }

}
