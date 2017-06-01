<?php
$today = date_create(date("Y-m-d H:i:s"));
$theirLast = date_create("2017-06-01 04:20:16");
date_add($theirLast,date_interval_create_from_date_string("5 minutes"));
echo $today->format("Y-m-d H:i:s")."<br />";
echo $theirLast->format("Y-m-d H:i:s");

if($today > $theirLast){
}