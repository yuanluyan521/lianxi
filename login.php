 <?php 
	header("content-type:text/html;charset=utf-8"); 
	$pdo  = new PDO("mysql:host=127.0.0.1;dbname=exam","root","root");
	$name = $_POST['name'];	// 前台传过来的用户名
	$pwd = $_POST['pwd'];		// 前台传过来的密码

	$sql = "select * from admin where name='$name' and pwd='$pwd'";
	$res = $pdo->query($sql)->fetch();	// 返回结果
	// print_r($res);exit;
	$id = $res['id'];
	setcookie("userid",$id);
	if($res){
		echo "<script>alert('登陆成功');location.href='show.php?id=$id';</script>";
	}else{
		echo "用户名或密码有误";
	}

 ?>