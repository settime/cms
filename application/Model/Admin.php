<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/7
 * Time: 1:36
 */

namespace app\Model;


use think\Model;

class Admin extends Model
{

    protected $pk = 'uid';


    public static function likeUsernameStr($username){
        $data = self::all(['username','like',"%{$username}%"])->getData();
        return twoArrToStr($data,'uid');
    }

}