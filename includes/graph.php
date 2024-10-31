<?php 
//$hodnoty = array(2,1,3,0,4,4,4,3,4,0,1,4);
$mwidth = intval($_REQUEST['width']);
//print $width;
if(max($d) > 9999){ $ciselnyindex = 1000; } else { $ciselnyindex = 100; }
//$ciselnyindex = 1000;
for ($i = 0; $i < $months_number; $i++){ $hodnoty[(int)$i]=$d[(int)$i+1] / $ciselnyindex; }
$max = max($hodnoty);
$setpocet = $max;
$index = 1.1;
$xpadding = 15 / $index;
$pocet = round($setpocet) + 1;
$ystep = 30 / $index;
$xstep = ((($mwidth - $xpadding) / $months_number)) / $index;
$fontsize = 10 / $index;
$strokewidth = 4 / $index;
$linescolor = '#ccc';
$polylinecolor = 'gold';
$graphcolor = 'green';
?>
<style type="text/css">
.graph .labels.x-labels {
  text-anchor: middle;
}

.graph .labels.y-labels {
  text-anchor: end;
}

.graph {
  height:<?php print ($ystep * $pocet) + (100 / $index); ?>px;
  width:<?php print ($xstep * $months_number)+ ($xstep / $index); ?>px;
 /* height: -webkit-fill-available !important;
  width: -webkit-fill-available !important; */
  font-family: cursive;
}

.graph .grid {
  stroke: <?php print $linescolor; ?>;
  stroke-dasharray: 0;
  stroke-width: <?php print $strokewidth / 2; ?>;
}

.labels {
  font-size: <?php print $fontsize + 1; ?>px;
  fill:<?php print $linescolor; ?>;
}

.label-title {
  font-weight: bold;
  text-transform: uppercase;
  font-size: <?php print $fontsize; ?>px;
  fill: black;
}

.dotted{ stroke-dasharray:5, 5 !important; stroke: <?php print $linescolor; ?> !important;  stroke-width: <?php print $strokewidth / 5; ?> !important; }
.data circle {
 /* fill: <?php print $graphcolor; ?>; */
  stroke-width: <?php print $strokewidth / 4; ?>;
}

.graph polyline{ stroke: <?php print $polylinecolor; ?>; stroke-width:<?php print $strokewidth; ?>; }
/*.graph circle{ stroke:<?php print $linescolor; ?>; }*/

.little{ font-size:<?php print $fontsize; ?>px; }
#svg-container{ overflow:auto; width:100%; height:100%; }
</style>
<div id="svg-container">
<svg version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="graph" aria-labelledby="title" role="img">
  <title id="title"></title>
<g class="grid x-grid" id="xGrid">
  <line x1="<?php print $xstep; ?>" x2="<?php print $xstep * $months_number; ?>" y1="<?php print ($ystep * $pocet); ?>" y2="<?php print ($ystep * $pocet); ?>"></line>
</g>
<g class="grid y-grid" id="yGrid">
  <line x1="<?php print $xstep; ?>" x2="<?php print $xstep; ?>" y1="<?php print $pocet * $ystep; ?>" y2="0"></line>
</g>

<?php
for ($n=$pocet; $n>=0; $n--) {
	$h = ($ystep * $pocet)-(($ystep * $n));
 if($n<>$pocet and $n <> 0){ ?>
<g class="grid x-grid dotted">
  <line x1="<?php print $xstep; ?>" x2="<?php print ($xstep * $months_number); ?>" y1="<?php print $h; ?>" y2="<?php print $h; ?>"></line>
</g>
<?php } } ?>
<polyline
     fill="none"
     points="
     <?php foreach($hodnoty as $k=>$v){ 
$yval = ($ystep * $pocet)-(($ystep * $v));
$xval = ($xstep * $k) + $xstep;
     	print $xval .','. $yval . ' '; } ?>
     "
   />
  <g class="labels x-labels">
  	<?php foreach($months as $k=>$m){ ?>
  <text x="<?php print $xstep * ($k); ?>" y="<?php print ($ystep * $pocet) + ($ystep * 1.5); ?>"><?php print $m[0]; ?></text>
  <?php } ?>
</g>
<g class="labels y-labels">
<?php $xhodnota = 3 * $xpadding;
for ($n=$pocet; $n>=0; $n--) {
	$h = ($ystep * $pocet)-(($ystep * $n)+($fontsize / 2));
	//$h = ($ystep * $n)-($ystep * $n);
 if($n<>$pocet){ print '<text x="'.($xhodnota).'" y="'. $h .'">'.round($n  * $ciselnyindex).get_woocommerce_currency_symbol().'</text>'; }
   } 
?>
</g>
<g class="data" data-setname="Our first data set">
	<?php $h = 0; foreach($hodnoty as $k=>$v){ 
$yval = ($ystep * $pocet)-(($ystep * $v));
$xval = ($xstep * $k) + $xstep; 
if($h < $v){ $f= $fontsize + $strokewidth; $ffill = 'green'; } else { $ffill = 'red'; $f = -$fontsize - $strokewidth - $strokewidth; }
?>
<circle fill="<?php print $ffill; ?>" cx="<?php print $xval; ?>" cy="<?php print $yval; ?>" data-value="<?php $v; ?>" r="<?php print $strokewidth * 2; ?>"></circle><text class="little" x="<?php $xxval = $xval - ($fontsize / 2); print $xxval; ?>" y="<?php $yyval = $yval - $f; print $yyval; ?>"><?php print ($v * $ciselnyindex); print  get_woocommerce_currency_symbol(); ?></text>
<?php $h=$v; } ?>
</g>
</svg></div>