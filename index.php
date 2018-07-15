<?php
ini_set('display_errors','0');
error_reporting (E_ALL & ~E_NOTICE);
session_start();
setlocale (LC_ALL, 'en_EN');
header('Content-Type: text/html; charset=utf-8');

include_once('url_parse.php');

include_once('class/helper.php');
include_once('class/socket.php');

$h = new helper();

if (!$content OR $content=="index") $content="home";

include_once('lib/functions.php');
?>

<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='utf-8' />
		
		<meta id='viewport' name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0' />
		<title>Mining Monitor</title>
	
		<!-- Vendor Styles -->
		<link href='https://fonts.googleapis.com/css?family=Rajdhani:400,600|Roboto:400,700' rel='stylesheet'>
	
		<!-- App Styles  -->
		<link rel='stylesheet' href='/css/style.css' />
		
	</head>
	<body>
		<div class='wrapper'>
			<header class='header'>
				<div class='shell'>
					<?php include('box_header.php'); ?>
					<?php include('navi_main.php'); ?>
				</div><!-- /.shell -->
				
			</header><!-- /.header -->
			<div class='content'>
				<?php include('content_'.$content.'.php'); ?>
			</div><!-- /.content -->
			<?php include('box_footer.php'); ?>
		</div><!-- /.wrapper -->
		
		<script src="/js/jquery-1.11.3.min.js"></script>
		<script src="/js/functions.js"></script>
		<input type='hidden' id='content' value='<?=$content;?>' />
		<input type='hidden' id='id' value='<?=$id;?>' />
	</body>
</html>