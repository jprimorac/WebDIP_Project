<?php

include_once 'baza.class.php';

include_once './dohvati_vrijeme.php';

$vrijeme = virtualno_vrijeme();
$test = date("Y-m-d H:i:s",$vrijeme);

echo $test;