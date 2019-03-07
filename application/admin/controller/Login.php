<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/28 0028
 * Time: 19:37
 */

namespace app\admin\controller;

use \Exception;
use think\Db;

class Login extends Common
{

    public function index()
    {
        return $this->fetch('/login');
    }

    /**
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $username = input('username');
        $password = input('password');
        //$key = input('key');
        $code = input('vercode');

        if (!captcha_check($code)) {
            returnAjax(400, '验证码不正确');
        }

        $findAdmin = getAdminUser($username);
        if (!$findAdmin) {
            returnAjax(400, '用户名或密码不正确');
        }

        if (!password_verify($findAdmin['uid']. $password . config('pass_admin'), $findAdmin['password'])) {
            returnAjax(400, '用户名或密码不正确');
        }

        $lastLoginTime = time();
        $LastUseTime = time();
        $findAdmin['last_use_time'] = $LastUseTime;
        $findAdmin['last_login_time'] = $lastLoginTime;

        //删除密码
        unset($findAdmin['password']);

        session('admin', $findAdmin);
        //更新登录时间
        Db::name('admin')->where('uid',$findAdmin['uid'])
            ->update([
                'last_login_time' => time(),
            ]);

        //更新登录ip
        adminLoginLog($findAdmin['uid'],1);
        returnAjax(200,'登录成功');
    }

    public function loginOut()
    {

    }
}