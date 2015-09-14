<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 27.05.14.
 * Time: 18:10
 */

ob_start();
session_start();
header('Content-type: text/html; charset=utf-8');
include_once './view/head.php';
include_once './prijava.php';


?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<div class = "navbar navbar-default navbar-static-top">

    <div class = "container">

        <? include_once "./controler/meni_odabir.php"; ?>

    </div>
</div>


<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src = "./js/bootstrap.js"></script>
<script src = "./scripts/navbar_aktiv.js"></script>

