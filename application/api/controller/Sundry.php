<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/8
 * Time: 1:46
 */

namespace app\api\controller;


use app\Model\Category;
use app\Service\Json;
use app\Service\TrafficStatistics;

class Sundry extends Auth
{

    public function categoryData(){
        $cat = Category::all([['delete_time','=',0]])->getData();
        $data =[];
        foreach ($cat as $k=>$v){
            $data[] = [
                'name' => $v['name'],
                'id'   => $v['id'],
                'pId' => $v['pid'],
                'open'  => true,
            ];
        }
        return json_encode($data);
    }

    public function trafficStatistics(){
        $data = TrafficStatistics::getToday();

        returnAjax(200,'成功',[
           'uvData' => Json::jsonArrayField($data,'')
        ]);
        dump($data);exit;
    }
}