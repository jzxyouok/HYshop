<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-03-31 0031
 * Time: 20:36
 * Http: www.hongyuvip.com
 */

header("Location: Shop/index.php");

exit;   //确保重定向后，后续代码不会被执行

//下面暂时隐藏,后续项目打开
/*
header("content-Type: text/html; charset=Utf-8"); //设置字符的编码是utp-8

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);
$this->display('Supperman:outerMan');

// 定义应用目录
define('APP_PATH','./shop/');

//设定目录生成的文件
define('DIR_SECURE_FILENAME','default.html');

//设置目录页面内容
define('DIR_SECURE_CONTENT','目录禁止');

//禁止目录主页生成
define('BUILD_DIR_SECURE','false');


// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
*/