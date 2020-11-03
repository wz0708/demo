<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 *

 */
class Users extends Model {

    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'Users';

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

}
