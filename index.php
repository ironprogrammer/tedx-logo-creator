<!DOCTYPE html><html><body>
<style>html,body,form,div,input,img{border:0;padding:0;margin:0;text-decoration:none;outline:0;}
body{background: #ccc; font: bold 24px/30px verdana; padding: 15px;}
img{margin: 0 0 15px; width: 300px;}
.col{float: left; margin: 0 20px 0 0; width: 300px;}
form{background: #ff5; border: solid 2px #dd3; padding: 15px 20px; margin: 0 0 20px; width: 576px;}
input{border: solid 1px #dd3; font: 24px/30px verdana; margin: 0 0 0 10px; padding: 6px 10px; width: 200px;}
</style>

<form action=".">Type TEDx Event Name:
<input type="text" name="name" value="<?php echo $_GET["name"]; ?>" /></form>
<p style="font: bold 16px/20px verdana; padding: 0 15px 0 230px;">Click to download:</p>
<div class="col">
<?php
for ($i=1; $i<9; $i++) {
	if ($i == 5) echo '</div><div class="col">';
	$path = 'image.php?name=' . (isset($_GET["name"]) ? $_GET["name"] : "Name") . '&type=' . $i;
	echo '<a href="', $path, '"><img src="', $path, '" /></a>';
}
?>
</div>
</body></html>