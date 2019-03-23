<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Db;

/**
 * @param int $status 状态
 * @param string $msg 信息
 * @param $res string|array|object 数据
 */
function returnAjax($status = 200, $msg = '', $res =[])
{
    echo json_encode([
        'status' => $status,
        'msg' => $msg,
        'res' => $res,
    ]);
    exit;
}

function getVariableSet($key){
    return  \app\Service\VariableSet::getValue($key);
}

/**
 * @return array
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function getMenu()
{
    $data = Db::name('menu')->where('delete_time', 0)
        ->order(['sort'=>'desc','id' => 'asc'])
        ->select();
    $menu =app\library\ClassTree::hTree($data);
    return $menu;
}

/**
 * @param array $formName
 * @return array
 * 接收form表单数据
 */
function receiveForm(array $formName){
    $result = [];
    foreach ($formName as $v){
        $result[$v] = input($v,'');
    }
    return $result;
}

/**
 * @param array $data
 * @param $field
 * @return string
 * 二维数组转str
 */
function twoArrToStr(array $data ,$field){
    $str = '';
    if(!$data){
        return $str;
    }
    foreach ($data as $v){
        $str .= $v[$field].',';
    }

    return rtrim($str,',');
}

function countIntervalTime($time1,$time2){
    $totalTime = $time2 - $time1;
    return $totalTime / 24;
}

function returnJsonStr($data){
    return json_encode( array_values($data));
}