<?php
/**
 * 后台商品控制器
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-04-04 0004
 * Time: 12:33
 * Http: www.hongyuvip.com
 */

namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    //商品列表展示
    function showlist(){
        $goods = D("Goods");
        $info = $goods -> select();
        $this -> assign('info',$info);

        //        $info = $goods -> find(30);
        //        show_bug($info);

        $this -> display();
    }

    function showlist_old_02(){
        //实例化 Model 对象
        $goods = D("Goods");

        //获取数据信息
        $info = $goods -> select();

        //$goods = D();
        //$info = $goods -> table('hy_goods') -> select();
        //show_bug($info);

        //输出调试变量信息
        //show_bug($info);
        //foreach($info as $k => $v){
        //    echo $v['goods_name']."<br/>";
        //}


        //价格大于1000元的商品 和 商品名字含有 海 字商品
        //$info = $goods -> where("market_price > 1000 and goods_name like '%海%'") -> select();

        //查询指定字段
        //$info = $goods -> field("goods_id,goods_name") -> select();

        //限制条数
        //$info = $goods -> limit(5,5) ->select();

        //分组查询 group by
        //查询当前商品一共的分组信息
        //通过分组设置可以查询每个分组的商品信息
        //例如: 每个分组下面有多少商品信息
        //      select goods_category_id,count(*) from group by category_id
        //      每个分组下面商品的价格算术和是多少
        //      select category_id,sum(price) from table group by category_id
        //$info = $goods -> field('goods_category_id')-> group('goods_category_id') ->select();

        //排序显示结果 order by market_price desc (desc降序/asc升序)
        //$info = $goods -> order('market_price desc') -> select();

        //把数据 assign 到模板
        $this -> assign('info',$info);
        $this -> display();
    }

    function showlist_old_01(){
        //使用数据model模型
        //实例化model对象
        //$goods = new \Model\GoodsModel();   //object(Model\GoodsModel)
        //$goods = D("Goods");    //object(Think\Model)
        //$goods = D();    //object(Think\Model)
        $goods = M('Goods');    //实例化Model对象,实际操作Goods数据表
        //$goods = M();    //object(Think\Model)

        show_bug($goods);

        //获得qq信息
        //$qq = new \Model\QqModel();
        //show_bug($qq);

        $this -> display();
    }

    //添加商品
    function add(){
        $goods = D("Goods");
        $ar = array(
            'goods_name' => 'iphone5S',
            'goods_price' => '5888',
            'goods_number' => '53'
        );
        $rst = $goods -> add($ar);

        if($rst > 0){
            echo "商品添加成功";
        }else{
            echo "商品添加失败";
        }

        $this -> display();
    }

    function add_goods(){
//        echo __SELF__;
        $goods = D("Goods");
        //两个逻辑 ①展现表单 ②接受表单数据
        if(!empty($_POST)){
            //print_r($_POST);
            //$ar -> goods_name = $_POST['goods_name'];
            //$ar = $_POST;
            //$z = $goods -> add($ar);
            $goods -> create(); //自动过滤非法字段
            $z = $goods -> add();
            if($z){
                echo "yes";
                //$this -> seuccess('添加商品成功',U(Goods/showlist));
            }else{
                echo "no";
                //$this -> error('添加商品失败',U(Goods/showlist));
            }
        }else{
            $this -> display();

        }
    }

    //修改商品
    function upd(){
        $this -> display();
    }

}
