<?php
// 实例化PDO对象
$pdo=new PDO('mysql:host=localhost;dbname=1606c;charset=utf8','root','root');

// 获取当前登录用户的ID
session_start();
$user_id=$_SESSION['user_id'];		// 获取存储在session中的用户ID

// 产品库存减少
$sql="select g.name,s.score,addtime from scorelog as s inner join goods as g on s.goods_id=g.id where user_id=$user_id";
$data=$pdo->query($sql)->fetchAll();
?>

<html>
<head>
	<title></title>
</head>
<body>
<table border='1'>
<tr><th>序号</th><th>商品名称</th><th>使用积分</th><th>兑换时间</th></tr>
<?php foreach($data as $key=>$value):?>
	<tr><td><?=$key+1?></td><td><?=$value['name']?></td><td><?=$value['score']?></td><td><?=date('Y-m-d',$value['addtime'])?></td></tr>
<?php endforeach;?>
</table>
</body>
</html>
