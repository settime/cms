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
    private $form =[
      'id' ,
        'key',
        'name',
        'value',
        'startDate',
        'overDate',
    ];

    public function index(){
        $page = input('page');
        $limit = input('limit');
        $result = receiveForm($this->form);
        if(!$this->request->isAjax()){
            return $this->fetch('/variableSet',$result);
        }

        $map = [];
        if($result['id']){
            $map[] =['id','=',$result['id']];
        }

        if($result['name']){
            $map[] = ['name','liek',"%{$result['name']}%"];
        }
        if($result['key']){
            $map[] = ['key','liek',"%{$result['key']}%"];
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

        $data = Db::name('variable_set')->where($map)->page($page,$limit)->order(['sort'=>'desc','id'=>'desc'])->select();
        return [
            'code' => 0,
            'msg' =>'success',
            'data'=>$data,
            'count' => Db::name('variable_set')->where($map)->count(),
        ];
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }

}