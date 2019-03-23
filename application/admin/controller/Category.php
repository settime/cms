<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/3
 * Time: 12:28
 */

namespace app\admin\controller;

use think\Db;

/**
 * Class Category
 * @package app\admin\controller
 * 类别管理
 */
class Category extends Auth
{


    public function index(){
        $form =$form =['id' , 'key', 'name', 'value', 'startDate', 'overDate',];
        $result = receiveForm($form);
        $categoryTree = \app\Service\Category::getTreeCategory();
        $result['categoryTree'] = $categoryTree;

        $data = \app\Service\Category::getAll();
        foreach ($data as $k=>$v){
            $data[$k]['open'] = true;
            $data[$k]['date'] = date('Y/m/d H:i:s');
        }
        $result['category'] = json_encode(array_values($data));
        return $this->fetch('/category',$result);
    }

    public function create(){
        $form =['pid', 'name', 'sort', 'is_enable'];
        $result = receiveForm($form);

        if(!$result['name']){
            returnAjax(400,'请输入类别名称');
        }
        $result['create_time'] = time();
        Db::name('category')->insertGetId($result);
        returnAjax(200,'添加成功');
    }

    public function delete(){
        $id = input('id/d');
        Db::name('category')->where('id',$id)->where('delete_time',0)->update([
            'delete_time'=> time(),
        ]);
        returnAjax(200,'删除成功');
    }

    public function update(){
        $id = input('id/d');
        $form =['pid', 'name', 'sort', 'is_enable'];
        $result = receiveForm($form);

        if(!$result['name']){
            returnAjax(400,'请输入类别名称');
        }
        Db::name('category')->where('id',$id)->update($result);
        returnAjax(200,'修改成功');
    }

    public function get(){

    }

}