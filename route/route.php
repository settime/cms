<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\facade\Route;

/**
 * 登录
 */
Route::get('','admin/login/index');
Route::group('admin',function (){
    /**
     * 首页
     */
    Route::any('home','admin/Home/index');
    Route::any('console','admin/Home/console');

    //变量配置
    Route::any('variable/index','admin/VariableSet/index');
    Route::post('variable/create','admin/VariableSet/create');
    Route::post('variable/update','admin/VariableSet/update');
    Route::post('variable/delete','admin/VariableSet/delete');
    Route::post('variable/get','admin/VariableSet/get');

    //类别配置
    Route::any('category/index','admin/category/index');
    Route::any('category/create','admin/category/create');
    Route::any('category/index','admin/category/index');

    //菜单
    Route::any('menu/index','admin/Menu/index');
    Route::any('menu/insert','admin/menu/insert');
    Route::any('menu/delete','admin/menu/delete');
    Route::any('menu/update','admin/menu/update');
    Route::any('menu/get','admin/menu/get');

    //日志
    Route::get('logAdmin','admin/log/logAdmin');

    //文章
    Route::any('article/index','admin/Article/index');
    Route::any('article/insert','admin/Article/insert');
    Route::any('article/delete','admin/Article/delete');
    Route::any('article/update','admin/Article/udate');
    Route::any('article/get','admin/Article/get');
    Route::any('article/select','admin/Article/select');
});



/**
 * API 接口
 */
Route::post('trafficStatistics','api/Sundry/trafficStatistics');

Route::post('api/logAdmin','api/log/logAdmin');