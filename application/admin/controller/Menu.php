<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1 0001
 * Time: 19:54
 */

namespace app\admin\controller;

use think\Db;

class Menu extends Auth
{


    /**
     * @return array
     * @notc 菜单列表
     */
    public function index()
    {
        $data = Db::name('menu')->where('delete_time', 0)->order([
            'sort' => 'desc',
            'id' => 'asc',
        ])->select();

        $arr = [];
        foreach ($data as $k => $v) {
            $arr[$k]['id'] = $v['id'];
            $arr[$k]['name'] = $v['name'];
            $arr[$k]['url'] = $v['url'];
            //$arr[$k]['icon'] = $v['icon'];
            $arr[$k]['pid'] = $v['pid'];
            $arr[$k]['status'] =1;
        }
        return $this->fetch('/menu', [
            'menu' => $arr,
            'data' => json_encode(array_values($arr)),
        ]);
    }

    /**
     * @notc 添加菜单
     */
    public function addMenu()
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
     * @notc 菜单详情
     */
    public function menuDetail()
    {
        $id = input('id');
        $data = Db::name('menu')->where('id', $id)->find();
        returnAjax(200, '成功', $data);
    }

    /**
     * @notc 删除菜单
     */
    public function deleteMenu()
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
    public function editMenu(model\Menu $menuModel)
    {
        $id = input('id');

        if (!$id) {
            $this->revert->fail('参数不正确');
        }
        $name = input('name');
        $icon = input('icon');
        $sort = input('sort');
        $url = input('url');

        if (!$name) {
            $this->revert->fail('请输入菜单名称');
        }
        $menuModel->save([
            'name' => $name,
            'url' => $url,
            'icon' => $icon,
            'sort' => $sort,
        ], ['id' => $id]);

        $this->revert->success('', '成功');

    }

}