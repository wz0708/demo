<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    /**
     * 登录模板显示
     * @return type
     */
    public function showLoginForm() {
        Auth::guard()->logout(); //退出当前登录的用户
        return view('admin.auth.login');
    }

    /**
     * 管理员登录
     * @param AdminLoginRequest $login_request
     * @return type
     */
    public function postLogin(AdminLoginRequest $login_request) {
        $data = $login_request->only('name', 'password');
        $result = Auth::guard('admin')->attempt($data, true);
        if ($result) {
            return redirect(route('admin.home'));
        } else {
            return redirect()->back()
                            ->with('name', $login_request->get('name'))
                            ->withErrors(['name' => '用户名或密码错误']);
        }
    }

    /**
     * 管理员退出登录
     * @return type
     */
    public function postLogout() {
        Auth::guard('admin')->logout();
        return redirect(route('home'));
    }

}
