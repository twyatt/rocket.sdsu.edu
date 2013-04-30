<?php
$title = 'Donate';
?>

<div class="page">
	<h1>Donate</h2>
	
<?php
if ($_REQUEST['action'] == 'success') {
?>
	Thank you!
<?php
} else {
?>
	You can donate via PayPal using the button below:
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="AGXHLLTLQD24G">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
<?php
}
?>
</div>