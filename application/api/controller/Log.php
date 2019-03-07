<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/7
 * Time: 22:42
 */

namespace app\api\controller;


use app\Model\Admin;
use app\Model\LogAdmin;

class Log extends Auth
{

    public function logAdmin()
    {
        $uid = input('uid');
        $username = input('username');
        $startDate = input('startDate');
        $overDate = input("overDate");
        $page = input('page');
        $limit = input('limit');
        $map = [];
        if ($uid) {
            $map[] = [
                'uid', '=', $uid,
            ];
        }
        if ($username) {
            $str = Admin::likeUsernameStr($username);
            if ($str) {
                $map[] = [
                    'uid', 'in', $str,
                ];
            }
        }

        if ($startDate) {
            $map[] = [
              'create_time','>', strtotime($startDate)
            ];
        }

        if ($overDate) {
            $map[] = [
                'create_time','>', strtotime($overDate)
            ];
        }
        return [
            'code' => 0,
            'msg' => '成功',
            'data' =>       LogAdmin::where($map)->page($page,$limit)->select(),
            'count' =>      LogAdmin::where($map)->count(),
        ];
    }

}