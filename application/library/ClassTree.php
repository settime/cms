<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/2 0002
 * Time: 16:09
 */

namespace app\library;

/**
 * 无限分类树（支持子分类排序）
 */
class ClassTree
{
    /**
     * 分类排序（降序）
     */
    static public function sort($arr, $cols)
    {
        //子分类排序
        foreach ($arr as $k => &$v) {
            if (!empty($v['son'])) {
                $v['son'] = self::sort($v['son'], $cols);
            }
            $sort[$k] = $v[$cols];
        }
        if (isset($sort))
            array_multisort($sort, SORT_DESC, $arr);
        return $arr;
    }

    /**
     * 横向分类树
     */
    static public function hTree($arr, $pid = 0)
    {
        foreach ($arr as $k => $v) {
            if ($v['pid'] == $pid) {
                $data[$v['id']] = $v;
                $data[$v['id']]['son'] = self::hTree($arr, $v['id']);
            }
        }
        return isset($data) ? $data : array();
    }

    /**
     * 纵向分类树
     */
    static public function vTree($arr, $pid = 0)
    {
        foreach ($arr as $k => $v) {
            if ($v['pid'] == $pid) {
                $data[$v['id']] = $v;
                $data += self::vTree($arr, $v['id']);
            }
        }
        return isset($data) ? $data : array();
    }
}