<?php 
if(!empty($_POST['orderId']) || !empty($_POST['brand']) ){
	$brandName = $_POST['brand'];	
	$orderId = $_POST['orderId'];
}else{
	$brand = "";
	$orderId = "";
}
require('URL.php');
$orderInfoAPIURL = $orderInfoAPI.$orderId; 

//APIコール、ブランド名とブランドテキストを取得
$responce = json_decode(file_get_contents($orderInfoAPIURL));

foreach ($responce as $key => $value) {
	$tempa['oderId'] = $value->orderId;
	$itemlist[$key]['title'] = $value->productInfo->title;
	$tempa['sku'] = $value->productInfo->sku;
	$tempa['url'] = $value->productInfo->url;
	$tempa['brand'] = $_POST['brand'];

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
	$itemlist[$key]['json'] = base64_encode(json_encode($tempa));
	$tempa = array();
	
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
						foreach ($itemlist as $key => $value) {
							echo '<div>';
							echo '<label>';
							echo '<input type="radio" class="items" name="item"value="'.$itemlist[$key]['json'].'">';
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
		<div>
			<a href="http://localhost:8080/survey/page1.php?brand=hoge">でばっぐ</a>	
		</div>
	</body>
</html>
