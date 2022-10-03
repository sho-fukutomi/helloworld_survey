<?php 
// var_dump($_POST);

if (!empty($_POST['item'])) {
	$items = json_decode(base64_decode($_POST['item']));
}else{
	echo "error";
}



var_dump($items);
$tempa['url'] = $items->url;
$tempa['orderId'] = $items->oderId;
$tempa['sku'] = $items->sku;
$tempa['brand'] = $items->brand;
$base64json = base64_encode(json_encode($tempa));

if(!empty($items->question1)){
	$questions[0] = $items->question1;
}
if(!empty($items->question2)){
	$questions[1] = $items->question2;
}
if(!empty($items->question3)){
	$questions[2] = $items->question3;
}
if(!empty($items->question4)){
	$questions[3] = $items->question4;
}
if(!empty($items->question5)){
	$questions[4] = $items->question5;
}

$brandName = $tempa['brand'] ;
// var_dump($questions);

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
			<div>質問にご回答ください</div>
			<div>
				<form method="post">
					<div>
						<div>
							<label>ギフト券をご送付させて頂く為にemailアドレスをご入力下さい
								<input type="email" name="email"  maxlength="100">
							</label>
						</div>
						<?php 
							foreach ($questions as $key => $value) {
								echo '<div>';
								echo '<label>';	
								echo $questions[$key];
								echo '<input type="text" name="answer';
								echo number_format($key) + 1 ;
								echo '">';
								echo '</label>';
						}
						?>
						<div>
							<label>商品の感想を教えて下さい
								<input type="text" name="feedback">
							</label>	
						</div>
						<div>
							<label>商品の満足度を選択してください</label>
							<select name="rating">
								<option>満足:★★★★★</option>
								<option>良い:★★★★</option>
								<option>普通:★★★</option>
								<option>不満:★★</option>
								<option>悪い:★</option>
								
							</select>
						</div>
					<input type="hidden" name="json" value="<?php echo $base64json ?>">
					<input type="hidden" name="reviewed" value="">

					<input type="submit" formaction="postdecision.php"  value="次へ">
				</form>
			</div>
		</div>
		<div>
			<a href="http://localhost:8080/survey/page1.php?brand=hoge">でばっぐ</a>	
		</div>
	</body>
</html>


