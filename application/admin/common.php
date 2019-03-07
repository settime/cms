<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/28 0028
 * Time: 22:32
 */

use think\Db;

/**
 * @param $username
 * @return array|null|PDOStatement|string|\think\Model
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 * 获取管理员
 */
function getAdminUser($username){
    return Db::name('admin')->where('username',$username)->find();
}

function getAdmin($uid){
    return Db::name('admin')->where('uid',$uid)->find();
}

/**
 * @param $uid int
 * @param $type int 1 登录 2退出
 */
function adminLoginLog($uid,$type){
    $ipea = new \app\library\IpArea();
    $ip = request()->ip();
    $data = $ipea->get($ip);
    Db::name('admin_login_log')->insertGetId([
       'uid' =>$uid,
        'ip' => $ip,
        'country' =>  isset($data['country']) ?$data['country']: '无法识别',
        'area' => isset($data['area'] )?$data['country']: '无法识别',
        'type' => $type,
        'create_time' => time(),
    ]);
}