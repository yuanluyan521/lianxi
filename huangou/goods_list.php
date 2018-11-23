<?php
header("content-type/html;charset=utf-8");
$pdo=new PDO('mysql:host=localhost;dbname=1606c;charset=utf8','root','root');
$sql="select * from goods";		// 从iwebshop_goods表中查询商品数据
$data=$pdo->query($sql)->fetchAll();
// echo '<pre/>';
// print_r($data);

// 查询用户的积分，如果用户所剩积分不足小于商品所需要积分，则不允许换购
session_start();
$user_id=$_SESSION['user_id'];		// 获取存储在session中的用户ID
$arr=$pdo->query("select score from user where id=$user_id")->fetch();
$user_score=$arr['score'];			// 用户积分

$sql="select * from scorelog";		// 用户购买的商品记录
$arrLog=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$arrGoodsId=array_column($arrLog,'goods_id');
$arrUserId=array_column($arrLog,'user_id');
// echo '<pre/>';
// print_r($arrLog);
// print_r($arrGoodsId)
?>

<html>
<head>
	<title></title>
	<script src='jquery.js'></script>
</head>
<body>
<!-- 展示商品列表 -->
<?php foreach($data as $key=>$value):?>
	<div style='float:left;margin:20px;'>
		<img src="<?php echo $value['img']?>">
		<p><?php echo $value['name']?><span style='float:right;'><?php echo $value['score']?> 积分</span></p>
		<!-- 判断当前登录用户是否已经换购过某商品，如果曾经换购过（在scorelog表中有此用户与某商品的记录），则将换购按钮设置为“已换购” -->
		<?php if(in_array($value['id'], $arrGoodsId) && in_array($user_id, $arrUserId)){?>
				<p id='huangou<?=$value['id']?>'>已换购</p>
		<?php }else{?>
				<!-- 单击“换购”按钮，执行tip函数，向tip传递了什么参数————商品ID，商品积分 -->
				<p id='huangou<?=$value['id']?>'><a href="javascript:;" onclick="tip(<?=$value['id']?>,<?=$value['score']?>);">换购</a></p>
		<?php }?>
	</div>
<?php endforeach;?>
</body>
</html>

<script>
// 参数 goods_id是商品ID，goods_score 是兑换商品所需要的积分
function tip(goods_id,goods_score){
	var user_score="<?php echo $user_score?>";		// 用户拥有的积分，将PHP变量转换成js变量

	alert("本商品换购需要"+goods_score+"积分");		// 提示用户兑换本商品需要多少积分

	// 如果用户所剩积分小于兑换商品所需的积分时，则提示“积分不足”
	if(user_score<goods_score){
		alert('积分不足');
		return false;
	}else{
		//document.getElementById('huangou').innerHTML='已换购';
		
		// 可以将下述location.href代码修改为发送ajax请求，以便使“换购”修改为“已换购”
		// 跳转到 huangou.php页面，在此文件中实现积分减少、库存减少、存放日志
		//location.href="huangou.php?goods_id="+goods_id+'&goods_score='+goods_score;

		$.ajax({
			url:'huangou.php?goods_id='+goods_id+'&goods_score='+goods_score,
			type:'get',
			dataType:'text',
			success:function(data){
				if(data=='ok'){
					alert('换购成功！');
					// 将“换购”按钮修改为“已换购”
					//$('#huangou').html("<a href='javascript:void(0);'>已换购</a>");
					$('#huangou'+goods_id).text("已换购");
				}
			}
		});
	}

}
</script>