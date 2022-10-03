<?php 
$otherinfo = json_decode(base64_decode( $_POST['json']));
$answers = $_POST;

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

if ($payloads['rating'] >= 4) {
	echo "kiteru";
	header('Location:review.php', true, 307);
}else{
	header('Location:thanks.php', true, 307);
}
exit;