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

    private $form =[
        'id' ,
        'key',
        'name',
        'value',
        'startDate',
        'overDate',
    ];

    public function index(){
        $result = receiveForm($this->form);
        if(!$this->request->isAjax()){
            return $this->fetch('/category',$result);
        }
    }

    public function create(){
        $form =['pid', 'name', 'sort', 'is_enable'];
        $result = receiveForm($form);

        if(!$result['name']){
            returnAjax(400,'请输入类别名称');
        }


        Db::name('category')->insertGetId($result);
        returnAjax(200,'添加成功');
    }


}