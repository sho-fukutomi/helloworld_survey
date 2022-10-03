<?php 
//PHPエリア、getの値を元に必要な情報を整理する




//?brand=hogehoge を取得、空の場合は空欄にする
if(!empty($_GET['brand'])){
	$brand = $_GET['brand'];	
}else{
	$brand = "";
}

//ブランド名を元にAPIコール用URLの生成
require('URL.php');
$brandInfoAPIURL =  $brandInfoAPI.$brand; 

//APIコール、ブランド名とブランドテキストを取得
$responce = json_decode(file_get_contents($brandInfoAPIURL));

//取得したブランド名とブランドテキストを整形、HTMLで使いやすい変数に格納する
$brandName = $responce->brand;
$homeTitle = $responce->homeTitle;
$brandText = $responce->homeText;

?>



<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $homeTitle;?> </title>
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div class="container">
			<h2><?php echo $homeTitle; ?></h2>
			<div></div>
			<div class="discriptions"><?php echo $brandText; ?></div>
			<div class="survey">
				<form method="post">
					<div class="items">	
						<label>注文番号を入力してください。</label>
					</div>
					<div>
						<input type="text" class="question" name="orderId" maxlength="20" value="" placeholder="000-000000-000000">
					</div>
					<input type="hidden" name="brand" value="<?php echo $brandName ?>">
					<p class="formbottom">
						<input class="btns" type="submit" formaction="page2.php"  value="次へ">	
					</p>
				</form>
			</div>
		</div>
	</body>
</html>