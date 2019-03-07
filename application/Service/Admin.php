<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/7
 * Time: 1:34
 */

namespace app\Service;


use app\Model\VariableSet;

class Admin
{

    public static function checkAdminSession(){
        if(!session('?admin')){
            return false;
        }
        $admin = session('admin');
        $findAdmin = \app\Model\Admin::get($admin['uid'])->getData();
        if($admin['last_login'] != $findAdmin['last_loin']){
            return false;
        }

        $expirationTime = VariableSet::get(['key'=>'expirationTime'])->getData('value');
        if(time() - $admin['lastUseTime'] > $expirationTime){
            return false;
        }
        $admin['lastUseTime'] = time();
        session('admin',$admin);
        return true;
    }



}