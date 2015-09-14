<?php

ob_start();
session_start();

if ($_SESSION["TIP"]==1) {
header("Location: administrator.php");
}
elseif ($_SESSION["TIP"]==2) {
header("Location: zaposlenik.php");
}
elseif ($_SESSION["TIP"]==3) {
header("Location: vlasnik.php");
}
else
    header("Location: pocetna.php");