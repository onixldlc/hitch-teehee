<?php
  require_once("./api/controller/home.php");
  require("./api/controller/config.php");
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
	<link rel="shortcut icon" href="img/CSC-Logo-kopong-400x400.png" type="image/x-icon">
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script defer src="js/homepage.js"></script>
	<title>HomePage</title>
</head>
<body>
	<div class="top">
		<div class="top-content">
		</div>
	</div>
	<div class="bottom">
		<div class="rooms">
			<div class="thread-container">

				<div class="threads thread-select">
					<div class="thread-left">
						<div class="thread-img">
							<img src="img/forum-img_global.png" height="50" width="50" alt="">
						</div>
					</div>
					<div class="thread-right">
						<div class="thread-top">
							<div class="thread-title">Global</div>
						</div>
						<div class="thread-bottom">
							<!-- <div class="thread-last-message"></div> -->
							<div class="thread-last-message">nice to see you man bla bla bla next next AA...</div>
						</div>
					</div>
				</div>
	
				<div class="threads thread-not-select">
					<div class="thread-left">
						<div class="thread-img">
							<img src="img/forum-img_main.png" height="50" width="50" alt="">
						</div>
					</div>
					<div class="thread-right">
						<div class="thread-top">
							<div class="thread-title">Main</div>
						</div>
						<div class="thread-bottom">
							<div class="thread-last-message"></div>
						</div>
					</div>
				</div>

			</div>
			

			<div class="threads thread-not-select" onclick="addThreadPrompt()">
				<div class="thread-left">
					<div class="thread-img">
						<img src="img/add-thread.png" height="50" width="50" alt="">
					</div>
				</div>
				<div class="thread-right">
					<div class="thread-adder">
						<div class="thread-title">add-thread</div>
					</div>
				</div>
			</div>
		</div>
		<div class="chat">
			<?php
				echo "<iframe src=\"http://chat".".$SRV_DOMAIN_NAME:$SRV_WEB_PORT"."/chat.php\" frameborder=\"0\"></iframe>";
			?>
		</div>
	</div>

</body>
</html>
