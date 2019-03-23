<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/13
 * Time: 0:06
 */

namespace app\Service;

use app\library\ClassTree;
use think\Db;

class Category
{

    public static function getAll(){
        return $category = Db::name('category')->where('delete_time',0)->select();
    }

    public static function getTreeCategory(){
        $category = Db::name('category')->where('delete_time',0)->select();

        $data = ClassTree::hTree($category);
        return $data;
    }

    public static function getNode($id){
        $child = Db::name('category')->where('pid',$id)->select();
        return $child;
    }

    public static function getTypeName($id){
        $find = Db::name('category')->where('id',$id)->find();
        if($find){
            return $find['name'];
        }
        return '';
    }


}