<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 *

 */
class Message extends Model {

    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'message';

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'content', 'created_at'
    ];

}
