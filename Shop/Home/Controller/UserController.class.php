<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-01 0001
 * Time: 21:24
 * Http: www.hongyuvip.com
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
    //用户登录
    function login(){
        $this -> display();
    }

    //用户注册
    function register(){
//        $user = D("User");
        $user = new \Model\UserModel();
        if(!empty($_POST)){
            $z = $user -> create();
            if(!$z){
                show_bug($user->getError());
                exit;
            }
            $rst = $user -> add();
            if($rst){
                echo "yes";
            }else{
                echo "no";
            }
        }else{
            $this -> display();
        }
    }

    function _empty(){
        echo "<center><img width='888' style='' src='".IMG_URL.'404.gif'."' alt=''/></center>";
        echo "<meta http-equiv=refresh content='3;url=".SITE_URL.'shop'."'>";
    }

    function number(){
        //模仿从数据库获得数据
        return "目前网站注册会员200万";
    }

}