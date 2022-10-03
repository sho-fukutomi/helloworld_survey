<?php
$otherinfo = json_decode(base64_decode( $_POST['json']));

$answers = $_POST;

// 今までの選択を元にpayloadsの作成
//ratingを数字に変換
switch ($answers['rating']) {
	case '満足:★★★★★':
		$payloads['rating'] = 5;
		break;
	case '良い:★★★★':
		$payloads['rating'] = 4;
		break;
	case '普通:★★★':
		$payloads['rating'] = 3;
		break;
	case '不満:★★':
		$payloads['rating'] = 2;
		break;
	case '悪い:★':
		$payloads['rating'] = 1;
		break;
	default:
		//error
		$payloads['rating'] = 0;
		break;
}

//ブランド名その他入れる
$payloads['brand'] = $otherinfo->brand;
$payloads['email'] = $answers['email'];
$payloads['orderId'] = $otherinfo->orderId;
$payloads['sku'] = $otherinfo->sku;
$payloads['feedback'] = $answers['feedback'];

//answerは１−５の可変なので、必要な場合入れる
if(!empty($answers['answer1'])){
	$payloads['answer1'] = $answers['answer1'];	
}
if(!empty($answers['answer2'])){
	$payloads['answer2'] = $answers['answer2'];
}
if(!empty($answers['answer3'])){
	$payloads['answer3'] = $answers['answer3'];
}
if(!empty($answers['answer4'])){
	$payloads['answer4'] = $answers['answer4'];
}
if(!empty($answers['answer5'])){
	$payloads['answer5'] = $answers['answer5'];
}
$payloads['url'] = $otherinfo->url;

//レビューしたかどうか
if(!empty($answers['reviewed'])){
	$payloads['reviewed'] = "Yes";	
}else{
	$payloads['reviewed'] = "";	
}

//上記payloadsを元に、APIコール用にpayloadを整形
$payload = 'payload='.urlencode(json_encode($payloads));


// curl リクエストエリア
require('URL.php');
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $postURL,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $payload,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$brandName = $otherinfo->brand;

// // echo $response;
// // var_dump($payloads['rating']);
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $brandName;?> </title>
		<link rel="stylesheet" href="common.css">
	</head>
	<body>
		<div>
			<div></div>
			<div>アンケートへのご回答ありがとうございました。</div>
			<div></div>
			<div>７日以内にギフト券をemailにてお送り致します。</div>
			
			
			
		</div>

		<div>
			<a href="http://localhost:8080/survey/page1.php?brand=hoge">でばっぐ</a>	
		</div>
	</body>
</html>



