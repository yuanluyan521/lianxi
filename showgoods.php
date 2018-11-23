 <?php 
	header("content-type:text/html;charset=utf-8"); 
	$pdo  = new PDO("mysql:host=127.0.0.1;dbname=exam","root","root");
	$id = $_COOKIE['userid'];
	$sql = "select * from score inner join goods on score.goods_id = goods.id where userid=$id";
	$res = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
				<td>换购时间</td>
			</tr>
		</tbody>
		<tbody id="tb">
		<?php foreach ($res as $val){ ?>
				<tr>
					<td><?php echo $val['goods_name']?></td>
					<td><?php echo $val['time']?></td>
				</tr>
			
		<?php } ?>
		</tbody>
	</table>
 </body>
 </html>