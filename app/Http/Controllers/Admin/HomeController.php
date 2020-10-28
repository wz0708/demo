<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class HomeController extends Controller {

    /**
     * HomeController constructor.
     */
    public function __construct() {

        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $userlist = DB::table('users')
                ->paginate(6);
        return view('admin.usermanage', ['userlist' => $userlist]);
    }

    public function userAction(Request $request) {
        $data = $request->all();
        $rules = ['uid' => ['required', 'string'], 'is_blacklist' => ['required', 'string']];
        $request->validate($rules);
        $res = DB::table('users')->where('id', $data['uid'])->update(['is_blacklist' => $data['is_blacklist']]);
        if ($res) {
            return response()->json(['msg' => "修改数据成功", 'code' => 200]);
        } else {
            return response()->json(['msg' => "修改数据失败", 'code' => 501]);
        }
    }

}
