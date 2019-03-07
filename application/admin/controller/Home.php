<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/1 0001
 * Time: 16:35
 */

namespace app\admin\controller;


class Home extends Auth
{

    public function index()
    {
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