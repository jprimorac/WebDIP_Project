<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 03.06.14.
 * Time: 01:23
 */
ob_start();
session_start();
include_once './controler/login.class.php';




if (!isset($_SESSION["PzaWeb"])) {
    include_once './view/neprijavljen_header.php';
    echo $no_login_meni;

}
elseif ($_SESSION["TIP"]==1) {
    include_once './view/admin_header.php';
    echo $admin_meni;
}
elseif ($_SESSION["TIP"]==2) {
    include_once './view/zaposlenik_header.php';
    echo $zapos_meni;
}
elseif ($_SESSION["TIP"]==3) {
    include_once './view/vlasnik_header.php';
    echo $vlasnik_meni;
}