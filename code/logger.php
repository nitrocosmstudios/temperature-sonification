<?php

$adj = 0; // Temperature adjustment in Fahrenheit.  Calibrate with another trusted thermometer after recording some samples.

$d = Array();
exec("temper-poll",$d);
if(isset($d[1])){
  $s = $d[1];
  $s = explode(' ',$s);
  $s = $s[3];
  $s = str_replace('°F','',$s);
  $s = (intval($s*100) / 100) + $adj;
  $ts = time();
  $ds = date("m/d/y H:i:s");
  file_put_contents('./temper.dat',$ts.' '.$s.' '.$ds."\n",FILE_APPEND);
} else {
  echo 'Could not read temperature.';
  exit();
}

?>
