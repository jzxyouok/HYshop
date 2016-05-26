<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-05-03 0003
 * Time: 19:02
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
    function show_user(){
        $user = D("User");
        $info = $user -> select();
        $this -> assign('info',$info);

        $this -> display();
    }

    function login(){
        $this -> display();
    }
    //添加会员
    function add(){
        $user = D("User");
        $ar = array(
            'username' => '鸿宇科技',
            'user_tel' => '18888888888',
            'user_email' => 'admin@hongyuvip.com',
            'user_qq' => '1527200768'
        );
        $rst = $user -> add($ar);

        if($rst > 0){
            echo "会员添加成功";
        }else{
            echo "会员添加失败";
        }
        $this -> display();
    }

}

