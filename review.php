<?php

$otherinfo = json_decode(base64_decode($_POST["json"]));

if(!empty($_POST['answer1'])){
	$answers['answer1'] = $_POST['answer1'];
}
if(!empty($_POST['answer2'])){
	$answers['answer2'] = $_POST['answer2'];
}
if(!empty($_POST['answer3'])){
	$answers['answer3'] = $_POST['answer3'];
}
if(!empty($_POST['answer4'])){
	$answers['answer4'] = $_POST['answer4'];
}
if(!empty($_POST['answer5'])){
	$answers['answer5'] = $_POST['answer5'];
}


$feedback = $_POST['feedback'];
$url = $otherinfo->url;
$brandName = $otherinfo->brand;

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
			<div>レビュー投稿にご協力ください。</div>
			<div>レビューをよろしくお願いいたします。</div>
			<div>投稿頂いた感想</div>
			<div><?php echo $feedback; ?></div>
			<div>を貼り付けていただくだけでも構いませんので、ご協力お願いいたします。</div>
			<div class="reviewbtn">
				<button class="jumpbtn" onclick="copy_jump()">レビュー投稿画面へ</button>
			</div>
			<div>別タブで遷移いたします。タップ時に感想をクリップボードにコピー致します。</div>
			<form method="post">
				<div><label>
					<input type="checkbox" name="reviewed" value="reviewed">
					レビューを投稿した
				</label></div>	
				<input type="hidden" name="email" value="<?php echo $_POST['email'] ?>">
				<input type="hidden" name="rating" value="<?php echo $_POST['rating'] ?>">
				<input type="hidden" name="feedback" value="<?php echo $_POST['feedback'] ?>">
				<input type="hidden" name="json" value="<?php echo $_POST['json'] ?>">
				
				<?php 
					foreach ($answers as $key => $value) {
						echo '<input type="hidden" name="';
						echo $key;
						echo '" value="';
						echo $answers[$key];
						echo '">';
					}
				 ?>
				 <p class="formbottom">
					<input type="submit" class="btns" formaction="thanks.php"  value="次へ">
				</p>
			</form>
			
		</div>
	</body>
</html>

<script type="text/javascript">
	console.log("<?php echo $url ?>");
	function copy_jump(){
    	
    	var content = "<?php echo $feedback ?>";
    	console.log(content)
    	navigator.clipboard.writeText(content)
        	.then(() => {
        		console.log("Text copied to clipboard...")
    		})
        	.catch(err => {
        		console.log('Something went wrong', err);
    		})
    		window.open('<?php echo $url ?>', '_blank');


	}	


</script>