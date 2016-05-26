<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-01 0001
 * Time: 21:40
 * Http: www.hongyuvip.com
 */
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller{
    //商品列表
    function showlist(){
        //获得User控制器的 number() 方法返回的信息
        //当前 UserController 会通过自动加载机制引入
        //ThinkPHP/Library/Think/Think.class.php    函数: function autoload();
        //$user = new UserController();
        // var_dump($user);
        //通过快捷函数实例化控制器对象
        //new一个控制器对象给我们返回
        //A([项目://][模块/]控制器标志)
        //$user = A("User");
        //echo $user -> number();
        echo R("User/number");
        //echo R("Admin/Goods/getMoney"); //跨模块调用(暂不可用)
        //echo R("shop://Admin/Goods/getMoney"); //跨模块调用(暂不可用)


        $this -> display();
    }

    //商品详情页
    function detail(){
        $this -> display();
    }
}