<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-03 0003
 * Time: 13:24
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Think\Controller;
class ManagerController extends Controller {
    function login(){
        //display()没有参数,那么获得的模板名称与当前操作的名称一致
        //$this -> display("hello");    Admin/View/Manager/hello.html
        $this -> display();
    }
}