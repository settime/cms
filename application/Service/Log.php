<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/7
 * Time: 2:07
 */

namespace app\Service;


class Log
{

    public static function logRecord($uid,$log){
        $data = [];
        $data['uid'] = $uid;
        $data['log'] = $log;
        $data['ip'] = request()->ip();
        $data['url'] = request()->controller().'/'.request()->action();
        \app\Model\LogAdmin::create($data);
    }


}