<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-13 0013
 * Time: 21:58
 * Http: www.hongyuvip.com
 */

namespace Model;
use Think\Model;

//父类 Model ThinkPHP/Library/Think/Model.class.php
class QqModel extends Model{
    //定义当前模型操作真实的数据表信息
    protected $tablePrefix      =   'tencent_';   // 数据表前缀
    //protected $trueTableName    =   'tencent_qq'; // 实际数据表名（包含表前缀）
}