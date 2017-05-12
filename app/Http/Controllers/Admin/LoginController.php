<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Support\Facades\Validator;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class LoginController extends CommonController
{
    public function login(Request $request)
    {
        if ($input = Input::all()) {
            if (strtolower($request->method()) == 'post') {
                $code = $request->input('code');
//            if (empty($_SESSION['code'])){
//                return json_encode(['status'=>2,'info'=>'验证码错误']);
//            }
                $sCode = $_SESSION['code'];
                if ($code == $sCode) {
                    unset($_SESSION['code']);
                    $user = User::first();
                    if ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']) {
                        return back()->with('msg','用户名或者密码错误!');

                    }
                    session(['user'=>$user]);
//                    dd(session('user'));
//                    return json_encode(['status' => 0, 'info' => '验证码正确']);
                return redirect('admin/index');
                } else {
                    return json_encode(['status' => 1, 'info' => '验证码错误']);
                }
            }
        }
        session(['user'=>null]);
        return view('admin.login');
//        $code = $request->input('code');
//        if ($input = Input::all()) {
//            $_code = $code;
//            if (strtoupper($input['code']) != $_code) {
//                return back()->with('msg', '验证码错误');
//            }
//            echo 'ok';
//        } else {
//            return view('admin.login');
//        }
    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
//更改超级管理员密码
    public function pass()
    {
        if ($input = Input::all()){
            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];
            $messages = [
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];
            $validator = Validator::make($input,$rules,$messages);
            if ($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if ($input['password_o']==$_password){
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功');
                }else{
                    return back()->with('errors','原密码错误');
                }
            }else{
                return back()->withErrors($validator);
            }

        }else{
            return view('admin.pass');
        }

    }
    public function code()
    {
        require_once app_path() . "/org/code/captcha.php";
    }

//    public function crypt()
//    {
//        $str = '1212123';
//        echo Crypt::encrypt($str);
//    }
}


