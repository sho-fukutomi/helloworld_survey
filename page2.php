<?php 
//POSTチェック
if(!empty($_POST['orderId']) || !empty($_POST['brand']) ){
	$brandName = $_POST['brand'];	
	$orderId = $_POST['orderId'];
}else{
	$brand = "";
	$orderId = "";
}

//URLリストより、オーダーAPIのURL取得
require('URL.php');
//オーダーAPIにオーダーIDをつけ、リクエストURL生成
$orderInfoAPIURL = $orderInfoAPI.$orderId; 

//APIコール、ブランド名とブランドテキストを取得
$responce = json_decode(file_get_contents($orderInfoAPIURL));

//簡易エラーチェック
if(!empty($responce[0]->productInfo->sku)){
	//商品毎に個別情報取得
	foreach ($responce as $key => $value) {
		$tempa['oderId'] = $value->orderId;
		$itemlist[$key]['title'] = $value->productInfo->title;
		$tempa['sku'] = $value->productInfo->sku;
		$tempa['url'] = $value->productInfo->url;
		$tempa['brand'] = $_POST['brand'];

		//質問文は５つと限らないので、あった場合のみ取得する
		if(!empty($value->productInfo->question1)){
			$tempa['question1'] = $value->productInfo->question1;	
		}
		if(!empty($value->productInfo->question2)){
			$tempa['question2'] = $value->productInfo->question2;
		}
		if(!empty($value->productInfo->question3)){
			$tempa['question3'] = $value->productInfo->question3;
		}
		if(!empty($value->productInfo->question4)){
			$tempa['question4'] = $value->productInfo->question4;
		}
		if(!empty($value->productInfo->question5)){
			$tempa['question5'] = $value->productInfo->question5;
		}
		//取得した商品情報をjson -> base64エンコード、POSTに載せやすくする
		$itemlist[$key]['json'] = base64_encode(json_encode($tempa));
		//テンポラリ配列を初期化
		$tempa = array();
		
	}
}else{
	//エラーだった場合、エラーページへ
	header('Location:error.php');
}


?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $brandName;?> </title>
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div class="container">
			<div></div>
			<div>商品を選択してください。</div>
			<div>
				<form method="post">
					<div>
						<?php 
							//アイテムの数だけラジオボックス生成
							//選択されたアイテムのjsonがポストに乗る形にする
							foreach ($itemlist as $key => $value) {
								echo '<div>';
								echo '<label>';
								echo '<input type="radio" class="items" name="item"value="';
								echo $itemlist[$key]['json'];
								echo '">';
								echo $itemlist[$key]['title'].'</label>';
								echo '</div>';
							}  
						?>
					</div>
					<input type="hidden" name="json" value="<?php echo $brandName ?>">
					<p class="formbottom">
						<input type="submit" class="btns" formaction="page3.php"  value="次へ">
					</p>
				</form>
			</div>
		</div>
	</body>
</html>
