<?php

namespace App\Logic;

use App\Model\Users;

/**
 *
 *  后台管理员逻辑层logic
 * @version 20120-11-02
 */
class AdminLogic {

    /**
     * 錯誤說明
     *
     * @var string
     */
    protected $error;

    /**
     * 验证数据
     * @param array $data
     * @return type
     */
    protected function validatorParams(array $data):bool {
        if (!isset($data['actionUser']) || $data['actionUser'] != 'admin') {
            $this->error = '修改用户必须管理操作';
            return false;
        }
        $user = Users::where('id', $data['uid'])->first();
        if (!$user) {
            $this->error = '用戶信息不存在';
            return false;
        }
        return true;        
    }

    /**
     * 处理首页留言数据
     * @return type
     */
    public function handle():object {
        //获取数据
        $model = Users::select('*');
        return $model;
    }

    /**
     *  修改会员用户状态
     */
    public function updateUsers(array $params):array {
        if (!$this->validatorParams($params)) {
            return ['status' => 401, 'msg' => $this->error];
        }
        $update = Users::where('id', '=', $params['uid'])->update(array('is_blacklist' => $params['isBlacklist']));
        if ($update) {
            return ['status' => 0, 'msg' => 'suc'];
        } else {
            return ['status' => 501, 'msg' => '服务器错误'];
        }
    }

}
