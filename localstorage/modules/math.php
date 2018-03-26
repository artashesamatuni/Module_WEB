<?php


function scaleNum($numIn, $scale, precision) {
  $tmpval = $numIn / $scale;
  return tmpval.toFixed(precision);
}

 ?>
