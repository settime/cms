<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2019/3/19
 * Time: 0:05
 */

namespace app\admin\controller;


class Article extends Auth
{

    public function index(){
        return $this->fetch('/article');
    }

    public function insert(){

    }

    public function delete(){

    }

    public function update(){

    }

    public function get(){

    }

    public function select(){

    }

}