<?php 
	header("content-type:text/html;charset=utf-8"); 
	$pdo  = new PDO("mysql:host=127.0.0.1;dbname=exam","root","root");
	$sql = "select * from goods";
	$res = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	//  查询用户的id
	$id = $_COOKIE['userid'];
	$sql1 = "select * from admin where id=$id";
	$data = $pdo->query($sql1)->fetch();
	// print_r($res);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<tbody>
			<tr>
				<td>商品名</td>
				<td>数量</td>
				<td>需要的积分</td>
				<td>操作</td>
			</tr>
		</tbody>
		<tbody>
		<?php foreach ($res as $val){ ?>
				<tr>
					<td><?php echo $val['goods_name']?></td>
					<td><?php echo $val['number']?></td>
					<td><?php echo $val['score']?></td>
					<td id="tb"><input type="button" value="换购" id="but" onclick="buy(<?php echo $val['score']?>,<?php echo $val['id']?>)"></td>
				</tr>
			
		<?php } ?>
		</tbody>
	</table>
</body>
</html>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
	function buy(score,goods_id){
		alert("此商品需要的积分为："+score);	
		var userscore = "<?php echo $data['score']?>";	// 用户的积分
		alert(userscore);
		if(userscore<score){
			alert("您的积分不足以换购此商品，滚蛋！");
			return false;
		}
		var _this = $(this);
		$.ajax({
			url:"change.php",
			data:{goods_id:goods_id,score:score},
			dataType:"json",
			type:"post",
			success:function(e){
				alert(e.msg);
				// location.reload();
				$("#tb").children().val("已换购");
			}
		});
		
	}




</script>