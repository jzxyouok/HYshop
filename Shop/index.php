<?php
/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-02 0002
 * Time: 0:37
 * Http: www.hongyuvip.com
 */

header("content-Type: text/html; charset=Utf-8"); //设置字符的编码是utp-8

//制作一个输出调试函数
function show_bug($msg){
    echo "<pre style='color:red;'>";
    var_dump($msg);
    echo "</pre>";
}

//控制器   {$smarty.const.__MODULE__}

//定义商城根目录
define("SITE_URL","http://localhost/"); // Shop商城根目录      {$smarty.const.SITE_URL}

//定义Home前台 css、img、js常量
define("CSS_URL",SITE_URL."Shop/Public/Home/css/");   //css    {$smarty.const.CSS_URL}
define("IMG_URL",SITE_URL."Shop/Public/Home/images/");   //img {$smarty.const.IMG_URL}
define("JS_URL",SITE_URL."Shop/Public/Home/js/");   //js       {$smarty.const.JS_URL}

//定义Admin后台 css、img、js常量
define("ADMIN_CSS_URL",SITE_URL."Shop/Public/Admin/css/");   //css    {$smarty.const.ADMIN_CSS_URL}
define("ADMIN_IMG_URL",SITE_URL."Shop/Public/Admin/img/");   //img {$smarty.const.ADMIN_IMG_URL}
define("ADMIN_JS_URL",SITE_URL."Shop/Public/Admin/js/");   //js       {$smarty.const.ADMIN_JS_URL}


define("SHOP_NAME","鸿宇多用户商城");   //商城名称    {$smarty.const.SHOP_NAME}
define("SHOP_NAME_JANE","鸿宇");   //商城名称简写    {$smarty.const.SHOP_NAME_JANE}
define("SHOP_TILE","鸿宇多用户商城 - hongyuvip.com");   //商城标题    {$smarty.const.SHOP_TILE}

// True 开启调试模式 建议开发阶段开启 部署阶段注释或者设为 False
define('APP_DEBUG',True);

// 引入ThinkPHP入口文件
require '../ThinkPHP/ThinkPHP.php';