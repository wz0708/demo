<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    public function showLoginForm() {

        return view('admin.login');
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

        return redirect('/class="caret"');
    }

}
