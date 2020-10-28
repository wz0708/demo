<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    public function showLoginForm() {

        return view('admin.auth.login');
    }

    public function postLogin(AdminLoginRequest $loginRequest) {

        $data = $loginRequest->only('name', 'password');
        $result = Auth::guard('admin')->attempt($data, true);
        if ($result) {
            return redirect(route('admin.home'));
        } else {
            return redirect()->back()
                            ->with('name', $loginRequest->get('name'))
                            ->withErrors(['name' => '用户名或密码错误']);
        }
    }

    public function postLogout() {

        Auth::guard('admin')->logout();

        return redirect(route('home'));
    }

}
