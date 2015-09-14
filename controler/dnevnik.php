<?php
/**
 * Created by PhpStorm.
 * User: Prima
 * Date: 11.06.14.
 * Time: 14:31
 */
ob_start();


class Dnevnik {

    public static function registracija($korIme,$uspjesno){
        include_once 'baza.class.php';
        $baza = new Baza();
        $upit="SELECT  idkorisnik FROM korisnik where korisnicko_ime = '$korIme';";
        $rezultat = $baza->selectDB($upit);
        $red = $rezultat->fetch_row();
        $id_kor=$red[0];
        $upit="insert into dnevnik_rada values(default,now(),'$uspjesno', '$id_kor',1,null);";
        $rezultat = $baza->selectDB($upit);
    }

    public static function prijava($korIme,$uspjesno){
        include_once './controler/baza.class.php';
        $baza = new Baza();
        $upit="SELECT  idkorisnik FROM korisnik where korisnicko_ime = '$korIme';";
        $rezultat = $baza->selectDB($upit);
        $red = $rezultat->fetch_row();
        $id_kor=$red[0];
        $upit="insert into dnevnik_rada values(default,now(),'$uspjesno', '$id_kor',2,null);";
        $rezultat = $baza->selectDB($upit);
    }

    public static function odjava($id_kor){
        include_once './baza.class.php';
        $baza = new Baza();
        $upit="insert into dnevnik_rada values(default,now(),1,'$id_kor',3,null);";
        $rezultat = $baza->selectDB($upit);
    }

    public static function insert($id_kor,$upit,$izcontrolera){
        if($izcontrolera==1)
            include_once 'baza.class.php';
        else
            include_once './controler/baza.class.php';
        $baza = new Baza();
        $upit="insert into dnevnik_rada values(default,now(),1,'$id_kor',9,\"$upit\");";

        $rezultat = $baza->selectDB($upit);
    }

    public static function update($id_kor,$upit,$izcontrolera){
        if($izcontrolera==1)
            include_once 'baza.class.php';
        else
            include_once './controler/baza.class.php';
        $baza = new Baza();
        $upit="insert into dnevnik_rada values(default,now(),1,'$id_kor',8,\"$upit\");";
        $rezultat = $baza->selectDB($upit);
    }

    public static function delete($id_kor,$upit,$izcontrolera){
        if($izcontrolera==1)
            include_once 'baza.class.php';
        else
            include_once './controler/baza.class.php';
        $baza = new Baza();
        $upit="insert into dnevnik_rada values(default,now(),1,'$id_kor',10,\"$upit\");";
        $rezultat = $baza->selectDB($upit);
    }

    public static function ostalo($korIme,$radnja,$izcontrolera){
        if($izcontrolera==1)
            include_once 'baza.class.php';
        else
            include_once './controler/baza.class.php';
        $baza= new Baza();
        $upit="SELECT  idkorisnik FROM korisnik where korisnicko_ime = '$korIme';";
        $rezultat = $baza->selectDB($upit);
        $red = $rezultat->fetch_row();
        $id_kor=$red[0];
        $baza = new Baza();
        $upit="insert into dnevnik_rada values(default,now(),1,'$id_kor','$radnja',null);";
        $rezultat = $baza->selectDB($upit);
    }


}