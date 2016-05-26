<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $this -> display();
    }
    function getName(){
        return "Shadow";
    }
    function weixin(){
        //微信Token对接
        $timestamp  = $_GET['timestamp'];
        $nonce      = $_GET['nonce'];
        $token      = 'weixin';
        $signature  = $_GET['signature'];
        $echostr    = $_GET['echostr'];

        $tmpStr     = array($timestamp,$nonce,$token);
        sort($tmpStr);

        $tmpStr     = sha1(implode($tmpStr));

        if($tmpStr == $signature && $echostr){
            echo $echostr;
            exit;
        }else{
            $this->reponseMsg();
        }
        /*
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
        */
    }
    //接收事件推送并回复
    function reponseMsg(){
        //获取到微信推送过来 post 数据 (xml格式)
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //处理消息类型,并设置回复类型和内容
        $postObj = simplexml_load_string($postArr);
        //$postObj->ToUserName ='';
        //$postObj->FromUserName ='';
        //$postObj->CreateTime ='';
        //$postObj->MsgType ='';
        //$postObj->Event ='';

        //判断该数据包是否是订阅的事件推送
        if(strtolower($postObj->MsgType) == 'event'){
            //如果是关注 subscribe 事件
            if(strtolower($postObj->Event) == 'subscribe'){
                //回复用户消息
                $toUser     = $postObj->FromUserName;
                $fromUser   = $postObj->ToUserName;
                $time       = time();
                $msgType    = 'text';
                $content    = '公共账号'.$postObj->ToUserName.",\n".'微信用户的openid:'.$postObj->FromUserName.",\n".'官方网站:'."<a href='http://hongyuvip.com'>鸿宇官网</a>";
                $template   = "<xml>
                               <ToUserName><![CDATA[%s]]></ToUserName>
                               <FromUserName><![CDATA[%s]]></FromUserName>
                               <CreateTime>%s</CreateTime>
                               <MsgType><![CDATA[%s]]></MsgType>
                               <Content><![CDATA[%s]]></Content>
                               </xml>";
                $info       = sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
                echo $info;
            }else{
                //如果是取消关注
                //if(strtolower($postObj->Event) == 'unsubscribe'){}
                $content    = '公共账号'.$postObj->ToUserName.",\n".'微信用户的openid:'.$postObj->FromUserName.",\n".'官方网站:'."<a href='http://hongyuvip.com'>鸿宇官网</a>";
                $myfile = fopen(C('SITE_URL')."Home/Controller/"."weixin.txt", "w") or die("Unable to open file!");
                $txt = $content."\n";
                fwrite($myfile, $txt);
                fclose($myfile);
                exit;
            }
        }

        if(strtolower($postObj->MsgType) == 'text'){
            switch(strtolower(trim($postObj->Content))){
                case 1:
                    $content    = '1.HongYu is very good!';
                    break;
                case 2:
                    $content    = '2.HongYu is very good!';
                    break;
                case 3:
                    $content    = '3.HongYu is very good!';
                    break;
                case 'hy':
                    $content    = 'HY is very good!';
                    break;
                default:
                    $content    = 'HongYu is very good!';
                    break;
            }
            $toUser     = $postObj->FromUserName;
            $fromUser   = $postObj->ToUserName;
            $time       = time();
            $msgType    = 'text';
            //$content    = 'HongYu is very good!';
            $template   = "<xml>
                           <ToUserName><![CDATA[%s]]></ToUserName>
                           <FromUserName><![CDATA[%s]]></FromUserName>
                           <CreateTime>%s</CreateTime>
                           <MsgType><![CDATA[%s]]></MsgType>
                           <Content><![CDATA[%s]]></Content>
                           </xml>";
            echo sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
        }

        function wx_content(){

        }

        /*
        //判断该数据包是否是 text 文本内容
        if(strtolower($postObj->MsgType) == 'text'){
            if(strtolower($postObj->Content) == 'hy'){
                $toUser     = $postObj->FromUserName;
                $fromUser   = $postObj->ToUserName;
                $time       = time();
                $msgType    = 'text';
                $content    = 'HongYu is very good!';
                $template   = "<xml>
                               <ToUserName><![CDATA[%s]]></ToUserName>
                               <FromUserName><![CDATA[%s]]></FromUserName>
                               <CreateTime>%s</CreateTime>
                               <MsgType><![CDATA[%s]]></MsgType>
                               <Content><![CDATA[%s]]></Content>
                               </xml>";
                echo sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
            }
        }
        */
    }
}