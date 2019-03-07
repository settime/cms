<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/28 0028
 * Time: 19:37
 */

namespace app\admin\controller;


use app\Service\Admin;
use think\App;

class Auth extends Common
{

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        if(!Admin::checkAdminSession()){
          //  echo '验证失效';exit;
        }
    }

}