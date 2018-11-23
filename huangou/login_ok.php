<?php
header("content-type/html;charset=utf-8");
// 接收数据
$name=$_POST['name'];
$password=md5($_POST['password']);

// 从数据库中查询是否有此用户，以便判断是否登录成功
$pdo=new PDO('mysql:host=localhost;dbname=1606c;charset=utf8','root','root');
$sql="select * from user where name='$name' and password='$password'";
if($data=$pdo->query($sql)->fetch()){
	// 将用户ID存储到session中
	session_start();		// 开启session
	$_SESSION['user_id']=$data['id'];		// 将用户ID存放到session中，以便在其他页面使用
	echo "<script>alert('登录成功');location.href='manager.html';</script>";	// 登录成功，跳转到了manager.html
}else{
	echo "<script>alert('用户名或密码错误，登录失败');location.href='login.html';</script>";
}