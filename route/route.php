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
/**
 * 首页
 */
Route::any('admin/home','admin/Home/index');

Route::any('admin/console','admin/Home/console');

//变量配置
Route::any('admin/variable/index','admin/VariableSet/index');

//变量配置
Route::any('admin/category/index','admin/category/index');
Route::any('admin/category/create','admin/category/create');
Route::any('admin/category/index','admin/category/index');

//菜单
Route::any('admin/menu/index','admin/Menu/index');
Route::any('admin/menu/index','admin/menu/index');
Route::any('admin/menu/index','admin/menu/index');
Route::any('admin/menu/index','admin/menu/index');

//日志
Route::get('admin/logAdmin','admin/log/logAdmin');


/**
 * API 接口
 */

Route::post('api/logAdmin','api/log/logAdmin');