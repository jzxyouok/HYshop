<?php
/**
 * 后台首页控制器
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-03 0003
 * Time: 13:14
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页frameset html框架集成方法

    function index(){
        $this -> display();
    }

    //后台首页
    function home_admin(){
//        $goods = D("Goods");
//        $info = $goods -> select();
//        $this -> assign('info',$info);
        $this -> display();
    }

    //左侧
    function left(){
        $this -> display();
    }

    //右侧
    function right(){
        $this -> display();
    }

    function deldir()
    {
        //删除目录下的文件：
        $dir = 'D:/HYshop/shop/Runtime/Cache/Admin';
        $dh=opendir($dir);

        while ($file=readdir($dh))
        {
            if($file!="." && $file!="..")
            {
                $fullpath=$dir."/".$file;

                if(!is_dir($fullpath))
                {
                    unlink($fullpath);
                }
                else
                {
                    deldir($fullpath);
                }
            }
        }
        closedir($dh);
        echo "<script>alert('后台缓存,清理成功');window.location = \"".SITE_URL.'shop/index.php/admin/index/index'."\";</script>";
    }

}