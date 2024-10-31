<style>

.chart{  width:100%; height:<?php print $max + 50; ?>px; }

.chart-block-overlay{ height:<?php print $max; ?>px; display:inline-block; margin-right:2%; width:<?php print $colwidth; ?>%; }

.chart-price{ display:inline-block; height:20px; text-align:center; width:100%; font-size:0.8vw; }

.chart-value{ display:inline-block; width:100%; }

.chart-months{ display:inline-block; height:20px; text-align:center; width:100%; font-weight:bold; margin-top:5px; font-size:1vw; }

.chart-inline{ height:100%; opacity:0.5; filter: alpha(opacity=50); }

.chart-value{ -webkit-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.2);

-moz-box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.2);

box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.2); }

</style>
<div class="chart">

<?php

for ($i = 1; $i <= $months_number; $i++) {

    if(isset($d[(int)$i])){

    $hodnota = ($d[(int)$i] / $height_index) / $percento;

    } else { $hodnota = 0; }

    $pznak = "%";

    if($hodnota == 0){ $hodnota = "1"; $pznak = "px"; }

    if($randomcolor == true){ $randhex = product_revenue_chart_randomHex(); } else { $randhex = $months[(int)$i][1]; }

    echo '<div class="chart-block-overlay">';

    if(isset($d[(int)$i])){ echo '<div class="chart-price">'.wc_price($d[(int)$i]).'</div>'; } else{ echo '<div class="chart-price">'.wc_price(0).'</div>'; }

    echo '<div style="height:'.$hodnota.$pznak.'; border:1px '.$randhex.' solid;" class="chart-value"><div style="background-color:'.$randhex.';" class="chart-inline"></div></div><div class="chart-months">'.$months[(int)$i][0].'</div></div>';

} ?></div>