<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 13.06.14.
 * Time: 23:53
 */

include_once './view/header.php';
include_once './controler/admin_podaci.php';

if (!isset($_SESSION["PzaWeb"])) {
    header("Location: greske.php?id_greske=12");
    exit();
}
if ($_SESSION["TIP"]!=1) {
    header("Location: greske.php?id_greske=13");
    exit();
}

echo "<div class=\"container\">";

Admin::zakljucani();
Admin::otkljucani();

echo "</div>";


?>
