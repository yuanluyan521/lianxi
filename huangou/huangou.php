<?php
// 实例化PDO对象
// header("content-type/html;charset=utf-8");
$pdo=new PDO('mysql:host=localhost;dbname=1606c;charset=utf8','root','root');


$goods_id=$_GET['goods_id'];			// 获取商品ID
$goods_score=$_GET['goods_score'];		// 兑换商品所需要的积分
// 获取当前登录用户的ID
session_start();
$user_id=$_SESSION['user_id'];		// 获取存储在session中的用户ID

// 产品库存减少
$sql="update goods set stock=stock-1 where id=$goods_id";
$pdo->exec($sql);

// 用户积分减少
$sql="update user set score=score-$goods_score where id=$user_id";
$pdo->exec($sql);

// 将积分扣除情况、商品换购情况记录到积分详情表中(用户ID、商品ID、兑换商品所需要积分、添加时间)
$time=time();
$sql="insert into scorelog(user_id,goods_id,score,addtime) values($user_id,$goods_id,$goods_score,$time)";
$pdo->exec($sql);		// 执行sql语句

//echo '换购成功，跳转中，请耐心等待...';
//header('refresh:3;url=goods_list.php');
echo 'ok';
?>
