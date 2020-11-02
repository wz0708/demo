<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

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
    public function index() {
        $list = DB::table('message')
                ->select('message.*', 'users.name', 'users.email')
                ->leftjoin('users', 'message.uid', '=', 'users.id')
                ->orderBy('message.id', 'desc')
                ->paginate(4);
        $user = Auth::user();
        return view('home', ['list' => $list, 'user' => $user]);
    }

    /**
     * 登录用户  有权限用户   可以添加留言
     * @param Request $request
     */
    public function note(Request $request):object {
        $user = Auth::user();
        $data = $request->all();
        $rules = ['content' => ['required', 'string', 'max:1024']];
        $messages = ['content.max' => '留言最大限制1024字数'];
        $request->validate($rules, $messages);
        $insert_data = ['uid' => $user->id, 'content' => $data['content'], 'created_at' => date('Y-m-d H:i:s')];
        $res = DB::table('message')->insert($insert_data);
        return $request->wantsJson() ? new Response('', 204) : redirect('/');
    }

}
