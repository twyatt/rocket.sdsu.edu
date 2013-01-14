<?php
$title = 'Rockets';
$head = <<<EOT
<link href="css/rockets.css" media="screen" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
function show(id) {
	$('.rocket').hide();
	$('#' + id).show();
	return false;
}
</script>
EOT;
?>

<div class="page">
	<div class="rocket">
		<h1>Rockets</h1>
		
		<ul class="rockets">
			<li class="first">
				<a onclick="show('swiss-miss'); return false;" class="rocket-link">
					<img src="images/swiss-miss-thumbnail.jpg" />
					<span class="rocket-name">Swiss Miss</span>
					<span class="launch-date">Launched October 20, 2012</span>
				</a>
			</li>
			<li>
				<a onclick="return show('delta-phoenix');" class="rocket-link">
					<img src="images/delta-phoenix-thumbnail.jpg" />
					<span class="rocket-name">Delta Phoenix</span>
					<span class="launch-date">Launched May 21, 2005</span>
				</a>
			</li>
			<li>
				<a onclick="return show('phoenix');" class="rocket-link">
					<img src="images/phoenix-thumbnail.jpg" />
					<span class="rocket-name">Phoenix I&amp;II</span>
					<span class="launch-date">Launch Attempt September 20, 2003</span>
				</a>
			</li>
			<li class="last">
				<a onclick="return show('machezuma');" class="rocket-link">
					<img src="images/machezuma-thumbnail.jpg" />
					<span class="rocket-name">Machezuma</span>
					<span class="launch-date">Launch Attempt September 20, 2003</span>
				</a>
			</li>
		</ul>
	</div>
	
	<div class="clear"></div>
	
	<div id="swiss-miss" class="rocket" style="display: none;">
<?php
include_once('partials/swiss-miss.php');
?>
	</div>
	
	<div id="delta-phoenix" class="rocket" style="display: none;">
<?php
include_once('partials/delta-phoenix.php');
?>
	</div>
	
	<div id="phoenix" class="rocket" style="display: none;">
<?php
include_once('partials/phoenix.php');
?>
	</div>
	
	<div id="machezuma" class="rocket" style="display: none;">
<?php
include_once('partials/machezuma.php');
?>
	</div>
</div>