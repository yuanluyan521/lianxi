<?php 
	header("content-type:text/html;charset=utf-8"); 
	$pdo  = new PDO("mysql:host=127.0.0.1;dbname=exam","root","root");
	$id = $_COOKIE['userid'];
	$sql = "select * from admin where id=$id";
	$res = $pdo->query($sql)->fetch();
	// print_r($res);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>您的积分为：<?php echo $res['score'];?> </h1>
	<hr>
	<a href="buy.php"><input type="button" value="换购商品"></a><br>
	<a href="showgoods.php">查看已换购的商品</a>
</body>
</html>