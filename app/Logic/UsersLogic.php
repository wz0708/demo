<?php

namespace App\Logic;

use App\Model\Message;
use App\Model\Users;
use App\Service\TimeFormatService;

/**
 *
 *  会员用户逻辑层logic
 * @version 20120-11-02
 */
class UsersLogic {

    /**
     * 参数   
     * @var array
     */
    protected $params = [];

    /**
     * 错误說明
     *
     * @var string
     */
    protected $error;

    /**
     * 设置参数
     */
    public function setParams($value = []) {
        $this->params = $value;

        return $this;
    }

    /**
     * 验证数据
     * @param array $data
     * @return type
     */
    protected function validatorParams(array $data) {
        if (!isset($data['uid'])) {
            $this->error = '用戶必须登录';
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
     * @param type $size
     * @return type
     */
    public function handle(int $size) {
        //获取数据
        $model = Message::join('users', 'message.uid', '=', 'users.id')
                ->select('message.*', 'users.name', 'users.email')
                ->orderBy('message.id', 'desc')
                ->paginate($size);
        foreach ($model as $key => $val) {//留言时间转换
            $model[$key]->created_at_str = TimeFormatService::timestampToStr($model[$key]->created_at);
        }
        return $model;
    }

    /**
     * 用户留言逻辑
     * @param array $params
     * @return type
     */
    public function userNote(array $params):array {
        if (!$this->validatorParams($params)) {
            return ['status' => 401, 'msg' => $this->error];
        }
        $data = [
            'uid' => $params['uid'],
            'content' => $params['content'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        if (Message::create($data)) {
            return ['status' => 0, 'msg' => 'suc'];
        } else {
            return ['status' => 501, 'msg' => '服务器错误'];
        }
    }

}
