<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 15.06.14.
 * Time: 14:33
 */
function dohvati() {
    $url = "http://arka.foi.hr/PzaWeb/PzaWeb2004/config/pomak.xml";
    $xml = file_get_contents($url);
    $dom = new DOMDocument();
    $dom->loadXml($xml);

    $xpath = new DOMXPath($dom);
    $vrijeme = $xpath->query("//PzaWeb/vrijeme/pomak");
    $pomak = $vrijeme->item(0)->getAttribute('brojSati');

    $fh = fopen("zapis_privremeno.php", "w");
    $string = '<?php return ' . $pomak . ';';
    if (fwrite($fh, $string)) {
        session_start();
        header('Location: ../index.php');
    }
    fclose($fh);
}

function sinkroniziraj() {
    $vrijeme = require "zapis_privremeno.php";

    $fileStream = fopen("zapis_vrijeme.php", "w");
    $string = '<?php return ' . $vrijeme . ';';
    if (fwrite($fileStream, $string)) {
        session_start();
        header('Location: ../index.php');
    }
    fclose($fileStream);
}

function virtualno_vrijeme() {
    $pomak = require "zapis_vrijeme.php";
    $pomak = $pomak * 3600;
    return time() + $pomak;
}

if (isset($_GET['akcija'])) {
    if ($_GET['akcija'] == "dohvati") {
        dohvati();
    } elseif ($_GET['akcija'] == "sinkroniziraj") {
        sinkroniziraj();
    }
}

?>