<?php

    require_once "connect_vars.php";

    class Destinacija{
        var $sifraDestinacije;
        var $nazivDestinacije;
        var $drzava;
        var $zipcode;


        public function __construct($sifraDestinacije, $nazivDestinacije, $drzava, $zipcode)
        {
            $this->sifraDestinacije = $sifraDestinacije;
            $this->nazivDestinacije = $nazivDestinacije;
            $this->drzava = $drzava;
            $this->zipcode = $zipcode;
        }


        public static function vratiImeKlase(){
            return "destinacija";
        }
    }

    class AvioKompanija{
        var $sifraAvioKompanija;
        var $nazivAvioKompanije;
        var $drzava;

        public function __construct($sifraAvioKompanija, $nazivAvioKompanije, $drzava)
        {
            $this->sifraAvioKompanija = $sifraAvioKompanija;
            $this->nazivAvioKompanije = $nazivAvioKompanije;
            $this->drzava = $drzava;
        }

        public static function vratiImeKlase(){
            return "AvioKompanija";
        }
    }

    class DestinacijaAvioKompanija{
        var $sifraAvioKompanija;
        var $sifraDestinacije;

        public function __construct($sifraAvioKompanija, $sifraDestinacije)
        {
            $this->sifraAvioKompanija = $sifraAvioKompanija;
            $this->sifraDestinacije = $sifraDestinacije;
        }

        public static function vratiImeKlase(){
            return "Destinacija_AvioKompanija";
        }
    }

    class Broker{


        public static function povezivanjeSaBazomPodataka(){
            $dbc  = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            return $dbc;
        }


        public static function prikaziIzBaze($imeKlase){
            $dbc = self::povezivanjeSaBazomPodataka();

            $upit = "Select * From $imeKlase";
            $rezultat = mysqli_query($dbc,$upit);

            return $rezultat;
        }

        public static function prikaziIzBazeJSON($imeKlase){
            $dbc = self::povezivanjeSaBazomPodataka();

            $upit = "Select * From $imeKlase";
            $rezultat = mysqli_query($dbc,$upit);

            return json_encode($rezultat);
        }

        public static function prikaziIzBazeUslov($imeKlase, $uslov){
            $dbc = self::povezivanjeSaBazomPodataka();

            $upit = "Select * From $imeKlase Where sifra$imeKlase=$uslov";
            $rezultat = mysqli_query($dbc,$upit);

            return $rezultat;
        }

        public static function zatvoriKonekciju($dbc){
            mysqli_close( $dbc);
        }
    }

 ?>