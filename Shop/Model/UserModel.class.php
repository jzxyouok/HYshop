<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-13 0013
 * Time: 21:14
 * Http: www.hongyuvip.com
 */

//商品数据模型 model
namespace Model;
use Think\Model;

//父类 Model ThinkPHP/Library/Think/Model.class.php
class UserModel extends Model{
    //实现表单项目验证
    //通过重写父类属性_validate实现表单验证
    protected $patchValidate    =   True;
    protected $_validate = array(
        //验证用户名
        array('user_name', 'require', '用户名不能为空'),
        array('password', 'require', '密码不能为空'),
    );
}

