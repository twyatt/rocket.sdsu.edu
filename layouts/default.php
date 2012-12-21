<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta charset="utf-8">
		<title>SDSU Rocket Project</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link href="css/reset.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="css/main.css" media="screen" rel="stylesheet" type="text/css" />
<?php if ($page != '') { ?>
		<link href="css/subpage.css" media="screen" rel="stylesheet" type="text/css" />
<?php } ?>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
			google.load("feeds", "1");
			google.load("jquery", "1.8.3");
			google.load("jqueryui", "1.9.2");
		</script>
	</head>
	
	<body>
		<div id="header">
			<div class="inner">
				<a href="index" id="logo">
					<img alt="San Diego State University Rocket Project" src="images/logo_rocket_project.gif">
				</a>
				
				<div id="header_links">
					<ul>
						<li class="first">
							<a href="join">Join</a>
						</li>
						<li>
							<a href="members">Members</a>
						</li>
						<li>
							<a href="donate">Donate</a>
						</li>
					</ul>
				</div>
				
<?php if ($page == 'home') { ?>
				<div id="banner">
					<div class="description">
						<h3>Rocketeers</h3>
						<div class="item_content">
							Rocket Project featured on the SDSU homepage!
						</div>
						<div class="item_more">
							<a href="http://newscenter.sdsu.edu/sdsu_newscenter/news.aspx?s=73975">Read More</a>
						</div>
					</div>
				</div>
<?php } ?>
			</div>
		</div>
		
		<div id="content">
			<div class="inner">
				<ul class="main_links">
					<li class="first">
						<a href="about">About</a>
					</li>
					<li>
						<a href="rockets">Rockets</a>
					</li>
					<li>
						<a href="schedule">Market</a>
					</li>
					<li>
						<a href="sponsors">Sponsors</a>
					</li>
					<li class="last">
						<a href="contact">Contact Us</a>
					</li>
				</ul>
				
<?php echo $content; ?>

			</div>
		</div>
		
		<div id="footer">
			<div class="inner">
				<div id="footer_left" class="column">
					<div id="social">
						<p>Online Communities</p>
						<a href="http://www.facebook.com/TheSdsuRocketProject" target="_blank">
							<img width="40" height="40" border="0" title="The Official SDSU Facebook Page" alt="Facebook icon" src="images/facebook_40px.png">
						</a>
						<a href="https://www.youtube.com/user/sdsurocket" target="_blank">
							<img width="40" height="40" border="0" title="The Official SDSU Rocket Project YouTube Channel" alt="YouTube icon" src="images/youtube_40px.png">
						</a>
						
						<div class="clear"></div>
					</div>
					
					<ul class="link_group">
						<li class="link">
							<a href="http://newscenter.sdsu.edu/sdsu_newscenter/news.aspx">News</a>
						</li>
						<li class="link">
							<a href="http://google.calstate.edu/search?access=p&amp;site=sdsu&amp;client=sdsu-edu&amp;proxystylesheet=sdsu-edu&amp;oe=UTF-8&amp;output=xml_no_dtd&amp;sort=date%253AD%253AL%253Ad1&amp;q=">Search</a>
						</li>
						<li class="link">
							<a href="http://phonebook.sdsu.edu/departmental/">Departments &amp; Offices</a>
						</li>
						<li class="link">
							<a href="http://phonebook.sdsu.edu/">Directory</a>
						</li>
						<li class="link">
							<a href="https://sunspot.sdsu.edu/map/">Maps</a>
						</li>
						<li class="link">
							<a href="http://police.sdsu.edu/parking.htm">Parking</a>
						</li>
						<li class="link">
							<a href="http://hr.sdsu.edu/employment/staffjobs.htm">Employment</a>
						</li>
						<li class="link">
							<a href="http://newscenter.sdsu.edu/experts/directory.aspx">Media Relations</a>
						</li>
					</ul>
					
					<div class="clear"></div>
				</div>
				<div id="footer_center" class="column">
					
				</div>
				<div id="footer_right" class="column">
					
				</div>
			</div>
		</div>
	</body>
</html>