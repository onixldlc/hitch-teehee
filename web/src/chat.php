<?php
	session_start();

	$isPost = $_SERVER['REQUEST_METHOD'] === "POST";
	$canChat = false;

	if( $isPost && isset($_POST["userid"]) && isset($_POST["username"]) ){
		$userid = $_POST["userid"];
		$username = $_POST["username"];
		$color = $_POST["color"];
		$thread = $_POST["thread"];
		$canChat = true;
	}
	require_once("./api/controller/chat.php");
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/chatRoom.css">
	
	<script src="https://cdn.socket.io/3.1.3/socket.io.min.js" integrity="sha384-cPwlPLvBTa3sKAgddT6krw0cJat7egBga3DJepJyrLl4Q9/5WLra3rrnMcyTyOnh" crossorigin="anonymous"></script>
	<script defer src="js/chat.js"></script>
	<script id="userData">
		<?php if($canChat) : ?>
		var cred = {
			"username":"<?=$username?>",
			"color":"<?=$color?>",
			"thread":"<?=$thread?>",
			"userid":"<?=$userid?>"
		}
		<?php endif;?>
	</script>

	<title>Thread</title>
</head>
<body>
	<div class="topChat">
		<div class="top-chat-content">
		</div>
	</div>
	<div class="bottomChat">
		<div class="chatContainer">
			<div class="chatInput">
				<!-- <textarea name="chat-input" id="chat-input" cols="1" rows="1"></textarea> -->
				<input type="textarea">
			</div>
			<button>Send</button>
		</div>
	</div>
</body>
</html>