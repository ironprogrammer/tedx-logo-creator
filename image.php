<?php
header("Content-type: image/png");
header("Expires: Mon, 01 Jul 2003 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/force-download");
header('Content-Disposition: attachment; filename="TEDx-' . $_GET["type"] . '.png"');

switch ($_GET["type"]) {
	case '1':	tedx("w", 240, 420, 136, 32, 170, 395, 170);	break;
	case '2':	tedx("w", 290, 420, 136, 32, 170, 32, 214);	break;
	case '3':	tedx("w", 370, 30, 267, 32, 300, 395, 300);	break;
	case '4':	tedx("w", 420, 30, 267, 32, 295, 32, 345);	break;

	case '5':	tedx("b", 240, 420, 136, 32, 170, 395, 170);	break;
	case '6':	tedx("b", 290, 420, 136, 32, 170, 32, 214);	break;
	case '7':	tedx("b", 370, 30, 267, 32, 300, 395, 300);	break;
	default:	tedx("b", 420, 30, 267, 32, 295, 32, 345);	break;
}

function tedx($color, $height, $name_x, $name_y, $tag1_x, $tag1_y, $tag2_x, $tag2_y) {
	$MAX_CHARS = 40;
	$FONT_FILE = "Helvetica.ttf";
	$TRACKING = 10;
	$TRACKING_EXTRA = 5;
	
	$t = urldecode(substr($_GET["name"], 0, $MAX_CHARS));
	if (substr($t, 0, 4) == "TEDx") $t = substr($t, 4);
	$width = strlen($t)*110 + ($name_x == "420" ? 450 : 0);
	if ($tag2_x == 395 && $width < 860) $width = 860;
	elseif ($width < 530) $width = 530;

	$img = imagecreatetruecolor($width, $height);
	imageantialias($img, true);
	imagefill($img, 0, 0, ($color == "w" ? imagecolorallocatealpha($img, 255, 255, 255, 127) : imagecolorallocatealpha($img, 0, 0, 0, 127)));
	imagecopy($img, imagecreatefrompng("tedx" . $color . ".png"), 30, 30, 0, 0, 365, 108);
	imagecopy($img, imagecreatefrompng("independently" . $color . ".png"), $tag1_x, $tag1_y, 0, 0, 354, 43);
	imagecopy($img, imagecreatefrompng("organized" . $color . ".png"), $tag2_x, $tag2_y, 0, 0, 420, 42);

	$pval = null;
	for($i=0;$i<strlen($t);$i++) {
		$value=substr($t,$i,1);
		if( ! is_null( $pval ) ){
			list($lx,$ly,$rx,$ry) = imagettfbbox(110,0,$FONT_FILE,$pval);
			if ( preg_match('/[Aafjtvwxy]/', $pval) )
				$nxpos += $rx;
			elseif ( preg_match('/[u]/', $pval) )
				$nxpos += $rx + $TRACKING_EXTRA + $TRACKING;
			elseif ( preg_match('/[1]/', $pval) )
				$nxpos += $rx + ($TRACKING_EXTRA * 2) + $TRACKING;
			else
				$nxpos += $rx + $TRACKING;
		} else {
			$nxpos=0;
		}
		imagettftext($img, 110, 0, $nxpos + $name_x, $name_y, ($color == "w" ? imagecolorallocate($img, 0, 0, 0) : imagecolorallocate($img, 255, 255, 255)), $FONT_FILE, $value);
		$pval=$value;
	}

	imagepng($img);
	ImageDestroy($img);
}
?>