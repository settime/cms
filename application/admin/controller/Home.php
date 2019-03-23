<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/1 0001
 * Time: 16:35
 */

namespace app\admin\controller;


use app\Service\Json;
use app\Service\TrafficStatistics;
use think\Db;

class Home extends Auth
{

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
      //  $uv = Db::name('uv')->select();

      //  dump(Json::jsonArr($uv));
     //   dump(Json::jsonArrayField($uv,'create_time'));exit;
        return $this->fetch('/home',
            [
                'menu' => getMenu()
            ]);
    }

    public function console()
    {
        return $this->fetch('/console');
    }


}