<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/8 0008
 * Time: 13:38
 */

namespace app\Service;

use app\library\Time;
use think\Db;

class TrafficStatistics
{

    public static function getToday(){
        $today = Time::today();
        $map = [];
        $map[] = ['create_time','>=',$today[0]];
        $map[] = ['create_time','<',$today[1]];

        $todayPv = self::getPvData($map);
        $todayUv = self::getUvData($map);
        return [
            'uv' => $todayUv,
            'pv' => $todayPv,
        ];
    }

    public static function getUvData($map =[]){
        $uvData = Db::name('uv')->where($map)->order(['id'=>'asc'])->select();
        return $uvData;
    }

    public static function getPvData($map){
        $pvData = Db::name('pv')->where($map)->order(['id'=>'asc'])->select();
        return $pvData;
    }

}