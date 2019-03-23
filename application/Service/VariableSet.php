<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/15
 * Time: 0:20
 */

namespace app\Service;


use think\Db;

class VariableSet extends Common
{

    public static function get($key){
        return Db::name('variable_set')->where('key',$key)->find();
    }

    public static function getValue($key){
        $find = self::get($key);
        if ($find){
            return $find['value'];
        }
        return '';
    }


}