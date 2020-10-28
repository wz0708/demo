<?php

function timeHandle(int $time):string {
    $now = time();
    $differ = $now - $time;
    $return = '';
    if ($differ < (60 * 60)) {
        $min_differ=floor($differ / 60);
        if($min_differ==0){
           $return = '刚刚'; 
        }else{
            $return = floor($differ / 60) . '分钟前';
        }        
    } elseif ($differ >= (60 * 60) && $differ < (60 * 60 * 24)) {
        $return = floor($differ / 60 / 60) . '小时前';
    } elseif ($differ >= (60 * 60 * 24) && $differ < (60 * 60 * 24 * 30)) {
        $return = floor($differ / 60 / 60 / 24) . '天前';
    } else {
        $return = date('Y年-m月-d日 H:i:s' , $time);
    }
    return $return;
}
