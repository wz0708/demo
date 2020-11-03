<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Logic\AdminLogic;

class HomeController extends Controller {

    /**
     * HomeController constructor.
     */
    public function __construct() {

        $this->middleware('auth:admin');
    }

    /**
     * 
     * 会员用户管理页面
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AdminLogic $logic) {
        $pager = $logic->handle()->paginate(6);
        return view('admin.usermanage', ['userlist' => $pager]);
    }

    /**
     * 管理员对会员管理操作
     * @param Request $request
     *              uid              会员用户id
     *              is_blacklist     0 解除黑名单  1 加入黑名单    
     * @return type
     */
    public function userAction(Request $request, AdminLogic $logic):object {
        $data = $request->all();
        $rules = ['uid' => ['required', 'string'], 'is_blacklist' => ['required', 'string']];
        $request->validate($rules);
        $res = $logic->updateUsers(array_merge($data, ['action_user' => Auth::guard('admin')->user()->name]));
        if ($res) {
            return response()->json(['msg' => "修改数据成功", 'code' => 200]);
        } else {
            return response()->json(['msg' => "修改数据失败", 'code' => 501]);
        }
    }

}
