<?php

/**
 * 留言时间显示转换  
 * string $time   留言时间
 * return  $retrun   转换后的时间  比如1分钟前   2小时前
 */
function timeHandle(string $time):string {
    $times = strtotime($time);
    $now = time();
    $differ = $now - $times;
    $return = '';
    if ($differ < (60 * 60)) {
        $minDiffer = floor($differ / 60);
        if ($minDiffer == 0) {
            $return = '刚刚';
        } else {
            $return = floor($differ / 60) . '分钟前';
        }
    } elseif ($differ >= (60 * 60) && $differ < (60 * 60 * 24)) {
        $return = floor($differ / 60 / 60) . '小时前';
    } elseif ($differ >= (60 * 60 * 24) && $differ < (60 * 60 * 24 * 30)) {
        $return = floor($differ / 60 / 60 / 24) . '天前';
    } else {
        $return = date('Y年-m月-d日 H:i:s', $time);
    }
    return $return;
}
