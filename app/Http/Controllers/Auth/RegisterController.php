<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * 验收是否游客
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * 验证参数
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data):object {
        return Validator::make($data, [
                    'name' => ['required', 'string', 'max:50','unique:users'],
                    'email' => ['required', 'string', 'email', 'max:50'],
                    'password' => ['required', 'string', 'min:', 'confirmed'],
        ]);
    }

    /**
     * 创建用户
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data):object  {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
        ]);
    }

}
