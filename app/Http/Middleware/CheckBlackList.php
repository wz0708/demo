<?php

namespace App\Http\Middleware;

use Closure;

class CheckBlackList {

    /**
     * .判断是否有权限留言
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Object $request, Closure $next):object {
        $isBlacklist = 0;
        if (!$request->user()) {//未登录用户 和黑名单用户一样只有查看权限
            $isBlacklist = 1;
        }
        if ($request->user()) {
            $isBlacklist = $request->user()->is_blacklist;
        }
        if ($isBlacklist == 1 && $request->isMethod('post')) {//黑名单用户 post提交留言 返回没有权限
            return response('该用户无权限操作', 403);
        }
        view()->share('isBlacklist', $isBlacklist);
        return $next($request);
    }

}
