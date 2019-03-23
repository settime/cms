<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/2 0002
 * Time: 17:46
 */

namespace app\admin\controller;

use think\Db;

/**
 * Class CommonSetting
 * @package app\admin\controller
 * 变量配置
 */
class VariableSet extends Auth
{

    public function index(){
        $page = input('page');
        $limit = input('limit');
        $form =[
            'id' , 'key', 'name', 'value', 'startDate', 'overDate', 'typeId',
        ];

        $result = receiveForm($form);

        if(!$this->request->isAjax()){
            $type = \app\Service\Category::getNode(2);
            $result['type'] = $type;
            return $this->fetch('/variableSet',$result);
        }

        $map = [];
        $map[] = ['delete_time','=',0];
        if($result['id']){
            $map[] =['id','=',$result['id']];
        }

        if($result['name']){
            $map[] = ['name','like',"%{$result['name']}%"];
        }
        if($result['key']){
            $map[] = ['key','like',"%{$result['key']}%"];
        }
        if($result['value']){
            $map[] = ['value','like',"%{$result['value']}%"];
        }
        if($result['startDate']){
            $map[] = ['create_time','>',strtotime($result['startDate'])];
        }
        if($result['overDate']){
            $map[] = ['create_time','<',strtotime($result['overDate'])];
        }

        if($result['typeId']){
            $map[] =['type_id','=',$result['typeId']];
        }

        $data = Db::name('variable_set')->where($map)->page($page,$limit)->order(['sort'=>'desc','id'=>'desc'])->select();
        foreach ($data as $k=>$v){
            $data[$k]['typeName'] =\app\Service\Category::getTypeName($v['type_id']);
        }
        return [
            'code' => 0,
            'msg' =>'success',
            'data'=>$data,
            'count' => Db::name('variable_set')->where($map)->count(),
        ];
    }

    private function check(){
        $form = ['type_id','name','key','value','sort'];
        $data = receiveForm($form);
        if(!$data['name']){
            returnAjax(400,'请输入标识名称');
        }
        if(!$data['key']){
            returnAjax(400,'请输入key');
        }
        if(!$data['value']){
            returnAjax(400,'请输入value');
        }
    }

    public function create(){
        $this->check();
        $form = ['type_id','name','key','value','sort'];
        $data = receiveForm($form);
        $data['create_time'] = time();
        if(\app\Service\VariableSet::get($data['key'])){
            returnAjax(400,'key已经存在,无法添加');
        }

        Db::name('variable_set')->insert($data);
        returnAjax(200,'添加成功');
    }

    public function update(){
        $this->check();
        $form = ['type_id','name','key','value','sort'];
        $data = receiveForm($form);
        $id = input('id/d');
        if(!$id){
            returnAjax(400,'id不正确');
        }
        Db::name('variable_set')->where('id',$id)->update($data);
        returnAjax(200,'修改成功');
    }

    public function delete(){
        $arr = ['delete_time'=>time()];
        $id = input('id/d');
        Db::name('variable_set')->where('id',$id)->where('delete_time',0)->update($arr);
        returnAjax(200,'删除成功');
    }

    public function get(){
        returnAjax(200,'成功',
            Db::name('variable_set')->where('id',input('id/d'))->find()
        );
    }

}