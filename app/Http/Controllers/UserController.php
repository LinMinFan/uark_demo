<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Org;
use App\Models\ApplyFile;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    
    public function index ()
    {
        return view('index');
    }

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

    public function getRegister()
    {
        $orgs = Org::all();

        return view('get_register',compact('orgs'));
    }

    public function postRegister(RegisterRequest $request)
    {
        
        if ($request->hasFile('apply_file')) {
            $apply_file = $request->file('apply_file');
            $extension = pathinfo($apply_file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = Carbon::now()->format('YmdHis').$extension;
            $fileName = mb_strtolower($fileName);
            $apply_file->storeAs('public/upload', $fileName);
            $file_path = 'upload/'.$fileName;
        } else {
            return redirect()->back()->with('error','請選擇上傳檔案');
        }

        $validated = $request->validated();

        $org = Org::where('org_no',$validated['org_no'])->first();

        if ($org) {
            $org_id = $org->id;
        } else {
            return redirect()->back()->with('error','單位號碼不存在');
        }

        $user_data = [
            'account' => $validated['account'],
            'name' => $validated['name'],
            'password' => $validated['password'],
            'email' => $validated['email'],
            'org_id' => $org_id,
            'birthday' => $request->birthday??null,
            'status' => 0,
        ];
        
        $user_data['password'] = Hash::make($user_data['password']);

        DB::beginTransaction();

        try {

            $existingUsers = User::where('account', $user_data['account'])
                ->orWhere('email', $validated['email'])
                ->get();
                
            if ($existingUsers->count() > 0) {
                throw new \Exception("帳號或郵件已存在");
            }else {
                $user = new User($user_data);
                $applyFile = new ApplyFile([
                    'file_path' => $file_path,
                ]);
                
                $user->save();
                $user->applyFile()->save($applyFile);
            }
    
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $type = 'error';
            $message = $e->getMessage();
            return redirect()->back()->with($type, $message);
        }
        
        return redirect()->route('get_login')->withSuccess('帳號註冊完成 歡迎登入');
    }

}
