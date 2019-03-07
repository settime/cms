<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/7
 * Time: 22:39
 */

namespace app\admin\controller;


class Log extends Auth
{

    protected $form=['uid','username','startDate','overDate'];

    public function logAdmin(){
        $result = receiveForm($this->form);
        return $this->fetch('log/logAdmin',$result);
    }

}