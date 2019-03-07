<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/28 0028
 * Time: 19:36
 */
namespace app\admin\controller;

use think\App;
use think\Controller;

class Common extends Controller
{

    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }

}