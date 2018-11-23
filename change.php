 <?php 
	header("content-type:text/html;charset=utf-8"); 
	// $redis = new Redis();
	// $redis->connect("127.0.0.1","6379");
	$id = $_COOKIE['userid'];		//  用户的id
	$goods_id = $_POST['goods_id'];		// 商品的id
	$score = $_POST['score'];		// 商品需要的积分
	$pdo  = new PDO("mysql:host=127.0.0.1;dbname=exam","root","root");
	//  查询库存量
	$sql2 = "select number from goods where id=$goods_id";
	$number = $pdo->query($sql2)->fetch();	/// 查询商品的库存量
	// if($redis->lpop("data".$goods_id)){
		if($number['number']>0){
			// 先减商品库存
			$sql = "update goods set number = number-1 where id=$goods_id";
			$res = $pdo->exec($sql);
			//  商品库存减掉后，给用户的积分减掉
			if($res){
				$time = date("Y-m-d");
				$sql1 = "update admin set score=score-$score";	//  这是减用户积分
				$ret = $pdo->exec($sql1);
				$sql3 = "insert into score values('','$id','换购商品','$goods_id','$score','$time')";//   添加入积分详情表
				$pdo->exec($sql3);
				if($ret){
					$data = array('code' =>1 ,'msg'=>"换购成功");
				}
			}
		}
	// }else{
	// 	$data = array('code' =>0 ,'msg'=>"换购失败");
	// }
	echo json_encode($data);
	//  redis 存入数据  只需要执行一遍
	// for($i=1;$i<=$number['number'];$i++){
	// 	$redis->lpush("data".$goods_id,$i);
	// }



























 ?>
