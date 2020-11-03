<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Logic\UsersLogic;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('checkblacklist');
    }

    /**
     * 首页  留言板页面
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, UsersLogic $logic) {
        $user = Auth::user();
        $param = $request->all();
        $size = $request->input('size', 4); //分页数
        $pager = $logic->setParams($param)->handle($size);
        return view('home', ['list' => $pager, 'user' => $user]);
    }

    /**
     * 登录用户  有权限用户   可以添加留言
     * @param Request $request
     */
    public function note(Request $request, UsersLogic $logic):object {
        $user = Auth::user();
        $param = $request->all();
        $rules = ['content' => ['required', 'string', 'max:1024']];
        $messages = ['content.max' => '留言最大限制1024字数'];
        $request->validate($rules, $messages);
        $res = $logic->userNote(array_merge(
                        $param, ['uid' => $user->id]
        ));
        return $res['status'] != 0 ? new Response('', 204) : redirect('/');
    }

}
