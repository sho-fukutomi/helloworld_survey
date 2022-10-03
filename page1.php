<?php 
//PHPエリア、getの値を元に必要な情報を整理する


require('URL.php');

//?brand=hogehoge を取得、空の場合は空欄にする
if(!empty($_GET['brand'])){
	$brand = $_GET['brand'];	
}else{
	$brand = "";
}

//ブランド名を元にAPIコール用URLの生成
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
		<div>
			<div><?php echo $homeTitle; ?></div>
			<div></div>
			<div><?php echo $brandText; ?></div>
			<div>
				<form method="post">
					<label>注文番号を入力してください。</label>
					<input type="text" name="orderId" maxlength="20" value="" placeholder="000-000000-000000">
					<input type="hidden" name="brand" value="<?php echo $brandName ?>">
					<input type="submit" formaction="page2.php"  value="次へ">
				</form>
			</div>
		</div>
		<div>
			<a href="http://localhost:8080/survey/page1.php?brand=hoge">でばっぐ</a>	
		</div>
		
	</body>
</html>