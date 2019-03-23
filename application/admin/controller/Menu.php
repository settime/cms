<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1 0001
 * Time: 19:54
 */

namespace app\admin\controller;

use app\library\ClassTree;
use think\Db;

class Menu extends Auth
{

    /**
     * @return array
     * @notc 菜单列表
     */
    public function index()
    {
        $data = Db::name('menu')->where('delete_time', 0)->order(['sort' => 'desc', 'id' => 'asc'])
            ->select();

        foreach ($data as $k => $v) {
            $data[$k]['address'] = $v['url'];
            unset($data[$k]['icon']);
            unset($data[$k]['url']);
            $data[$k]['open'] =true;
        }
        return $this->fetch('/menu', [
            'menu' => ClassTree::hTree($data),
            'data' => json_encode(array_values($data)),
        ]);
    }

    /**
     * @notc 添加菜单
     */
    public function insert()
    {
        $form = ['pid', 'name', 'url', 'sort', 'icon'];
        $result = receiveForm($form);

        if (!$result['name']) {
            returnAjax(400, '请输入菜单名称');
        }
        Db::name('menu')->insertGetId($result);
        returnAjax(200, '添加成功');
    }

    /**
     * @notc 删除菜单
     */
    public function delete()
    {
        $id = input('id');
        $menu = Db::name('menu')->where('id', $id)->where('delete_time', 0)->find();
        if ($menu) {
            Db::name('menu')->where('id|pid', $menu['id'])->update([
                'delete_time' => time(),
            ]);
        }
        returnAjax(200, '成功');
    }

    /**
     * @notc 修改菜单
     */
    public function update()
    {
        $id = input('id/d');
        returnAjax(400,'测');
        $form = ['pid', 'name', 'url', 'sort', 'icon'];
        $result = receiveForm($form);
        if (!$result['name']) {
            returnAjax(400,'请输入菜单名称');
        }
        Db::name('menu')->where('id',$id)->update($result);
        returnAjax(200,'成功');
    }


    /**
     * @notc 菜单详情
     */
    public function get()
    {
        $id = input('id');
        $find = Db::name('menu')->where('id', $id)->find();
        returnAjax(200, '成功', $find);
    }

}