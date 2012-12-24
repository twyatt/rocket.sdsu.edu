<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta charset="utf-8">
		<link rel="shortcut icon" href="favicon.ico" />
		
		<title>SDSU Rocket Project</title>
		
		<!-- <link href="css/all.css" media="screen" rel="stylesheet" type="text/css" /> -->
		<link href="css/reset.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/sticky.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/common.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/menu.css" media="screen" rel="stylesheet" type="text/css" />
<?php if ($page == 'home') { ?>
		<link href="css/home.css" media="screen" rel="stylesheet" type="text/css" />
<?php } else { ?>
		<link href="css/page.css" media="screen" rel="stylesheet" type="text/css" />
<?php } ?>
		<!--[if !IE 7]>
			<style type="text/css">
				#wrap {
					display: table;
					height: 100%;
					width: 100%;
				}
			</style>
		<![endif]-->
		
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
			google.load("feeds", "1");
			google.load("jquery", "1.8.3");
			google.load("jqueryui", "1.9.2");
		</script>
	</head>
	
	<body>
		<div id="wrap">
			<div id="header">
<?php include('partials/header.php'); ?>
			</div>
			
			<div id="content">
				<div class="content-container">
					<div class="inner">
						<div class="border">
<?php echo $content; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
<?php include('partials/footer.php'); ?>
		</div>
	</body>
</html>