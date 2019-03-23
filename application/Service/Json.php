<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/22
 * Time: 1:08
 */

namespace app\Service;


class Json
{
    /**
     * @param array $arr
     * @return string
     */
    public static function jsonArr($arr = []){
        return json_encode(array_values($arr));
    }

    /**
     * @param array $arr
     * @param $field
     * 数组某个字段转json
     */
    public static function jsonArrayField($arr = [],$field){
        return json_encode(array_column($arr,$field));
    }


}