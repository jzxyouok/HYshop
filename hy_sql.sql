/*
 * 鸿宇多用户商城 - 数据库
 * Created by PhpStorm.
 * User: Shadow
 * Date: 2016-05-08 0008
 * Time: 18:18
 * Http: www.hongyuvip.com
 */

CREATE TABLE `hy_admin_user` (
`admin_id`  smallint(5) UNSIGNED NULL AUTO_INCREMENT COMMENT '管理员自增id编号' ,
`admin_name`  varchar(100) NOT NULL COMMENT '管理员用户名' ,
`password`  varchar(255) NOT NULL COMMENT '密码' ,
`email`  varchar(100) NOT NULL COMMENT '邮箱' ,
`mobile`  varchar(11) NOT NULL COMMENT '手机号' ,
`question`  varchar(100) NOT NULL COMMENT '密保提问' ,
`answer`  varchar(100) NOT NULL COMMENT '密保回答' ,
`reg_time`  int(10) NOT NULL COMMENT '注册时间' ,
`last_login`  int(11) NOT NULL COMMENT '最后一次登录时间' ,
`is_status`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可用;0否;1是' ,
PRIMARY KEY (`admin_id`)
)
;

CREATE TABLE `hy_user` (
`user_id`  mediumint(8) UNSIGNED NULL AUTO_INCREMENT COMMENT '会员自增id编号' ,
`user_name`  varchar(100) NOT NULL COMMENT '会员用户名' ,
`password`  varchar(255) NOT NULL COMMENT '密码' ,
`email`  varchar(100) NOT NULL COMMENT '邮箱' ,
`mobile`  varchar(11) NOT NULL COMMENT '手机号' ,
`tel`  varchar(20) NOT NULL COMMENT '固定电话' ,
`address`  varchar(100) NOT NULL COMMENT '联系地址' ,
`sex`  tinyint(1) NOT NULL COMMENT '性别' ,
`birthday`  date NOT NULL COMMENT '出生日期' ,
`qq`  varchar(20) NOT NULL COMMENT 'qq' ,
`truename`  varchar(10) NOT NULL COMMENT '真实姓名' ,
`money`  decimal(10,2) NOT NULL COMMENT '余额' ,
`pay_points`  int(10) NOT NULL COMMENT '消费积分' ,
`rank_points`  int(10) NOT NULL COMMENT '会员等级积分' ,
`headimg`  varchar(255) NOT NULL COMMENT '用户头像图片路径' ,
`source`  varchar(20) NOT NULL COMMENT '注册来源' ,
`question`  varchar(100) NOT NULL COMMENT '密保提问' ,
`answer`  varchar(100) NOT NULL COMMENT '密保回答' ,
`parent_id`  mediumint(9) NOT NULL COMMENT '推荐人会员id' ,
`reg_time`  int(10) NOT NULL COMMENT '注册时间' ,
`last_login`  int(11) NOT NULL COMMENT '最后一次登录时间' ,
`is_status`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可用;0否;1是' ,
PRIMARY KEY (`user_id`)
)
;

CREATE TABLE `hy_goods` (
`goods_id`  mediumint(8) UNSIGNED NULL AUTO_INCREMENT COMMENT '商品自增id编号' ,
`goods_name`  varchar(100) NOT NULL COMMENT '商品名称' ,
`goods_intro`  varchar(255) NOT NULL COMMENT '介绍' ,
`goods_keywords`  varchar(255) NOT NULL COMMENT '关键字' ,
`market_price`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '市场价' ,
`shop_price`  decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT '商城价格' ,
`goods_number`  mediumint(5) NOT NULL COMMENT '商品库存' ,
`goods_sales`  mediumint(5) NOT NULL COMMENT '商品销量' ,
`goods_img`  varchar(255) NOT NULL COMMENT '图片路径' ,
`is_status`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否上架;0否;1是' ,
PRIMARY KEY (`goods_id`)
)
;

CREATE TABLE `hy_order` (
`order_id`  mediumint(8) UNSIGNED NULL AUTO_INCREMENT COMMENT '订单自增id编号' ,
`order_sn`  varchar(20) NOT NULL COMMENT '订单号' ,
`user_id`  mediumint(8) NOT NULL COMMENT '会员id' ,
`supplier_id`  mediumint(8) NOT NULL COMMENT '商家id' ,
`email`  varchar(100) NOT NULL COMMENT '邮箱' ,
`mobile`  varchar(11) NOT NULL COMMENT '手机号' ,
`tel`  varchar(20) NOT NULL COMMENT '固定电话' ,
`pay_name`  varchar(100) NOT NULL COMMENT '支付方式名称' ,
`address`  varchar(100) NOT NULL COMMENT '联系地址' ,
`order_number`  smallint(5) NOT NULL COMMENT '数量' ,
`market_price`  decimal(10,2) NOT NULL COMMENT '商品的市场售价，取值goods' ,
`goods_price`  decimal(10,2) NOT NULL COMMENT '商品的本店售价，取值goods' ,
`is_status`  tinyint(1) NOT NULL COMMENT '是否交易完成;0否;1是' ,
PRIMARY KEY (`order_id`)
)
;

CREATE TABLE `hy_payment` (
`pay_id`  tinyint(3) UNSIGNED NULL AUTO_INCREMENT COMMENT '支付方式自增id编号' ,
`pay_code`  varchar(20) NOT NULL COMMENT '支付方式英文缩写' ,
`pay_name`  varchar(100) NOT NULL COMMENT '支付方式名称' ,
`pay_desc`  text NOT NULL COMMENT '支付方式描述' ,
`pay_order`  tinyint(3) NOT NULL COMMENT '支付方式在页面的显示顺序' ,
`pay_config`  text NOT NULL COMMENT '支付方式的配置信息' ,
`is_cod`  tinyint(1) NOT NULL COMMENT '是否货到付款;0否,1是' ,
`is_online`  tinyint(1) NOT NULL COMMENT '是否在线支付;0否;1是' ,
`is_status`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可用;0否;1是' ,
PRIMARY KEY (`pay_id`)
)
;

CREATE TABLE `hy_payment_log` (
`log_id`  mediumint(8) UNSIGNED NULL AUTO_INCREMENT COMMENT '支付记录自增id编号' ,
`order_id`  mediumint(8) NOT NULL COMMENT '订单id' ,
`order_amount`  decimal(10,2) NOT NULL COMMENT '支付金额' ,
`order_type`  tinyint(1) NOT NULL COMMENT '支付类型;0订单支付,1会员预付款支付' ,
`is_paid`  tinyint(1) NOT NULL COMMENT '是否付款;0否;1是' ,
PRIMARY KEY (`log_id`)
)
;

CREATE TABLE `hy_shop_config` (
`id`  smallint(5) UNSIGNED NULL AUTO_INCREMENT COMMENT '商城配置自增id编号' ,
`parent_id`  smallint(5) NOT NULL COMMENT '所属配置项' ,
`code`  varchar(30) NOT NULL COMMENT '配置英文缩写' ,
`config_type`  varchar(10) NOT NULL COMMENT '配置属性' ,
`config_value`  text NOT NULL COMMENT '配置值' ,
PRIMARY KEY (`id`)
)
;