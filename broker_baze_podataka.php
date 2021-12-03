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

    class Putnik{
        var $sifraPutnik;
        var $ime;
        var $prezime;
        var $sifraDestinacija;
        var $sifraAvioKompanija;

        public function __construct($sifraPutnik, $ime, $prezime, $sifraDestinacija, $sifraAvioKompanija)
        {
            $this->sifraPutnik = $sifraPutnik;
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->sifraDestinacija = $sifraDestinacija;
            $this->sifraAvioKompanija = $sifraAvioKompanija;
        }

        public static function vratiImeKlase(){
            return "Putnik";
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

        public static function ubaciUBazu($imeKlase,$ime,$prezime,$dest,$avioKomp){
            $dbc = self::povezivanjeSaBazomPodataka();

            $upit = "Insert Into  $imeKlase (ime,prezime,sifraDestinacija,sifraAvioKompanija) Values ('$ime','$prezime',$dest,$avioKomp)";

            mysqli_query($dbc,$upit);
        }

        public static function izbaciIzBaze($imeKlase,$ime,$prezime){
            $dbc = self::povezivanjeSaBazomPodataka();

            $selectUpit = "Select ime,prezime From ".Putnik::vratiImeKlase();
            $rez = mysqli_query($dbc,$selectUpit);

            while ($red = mysqli_fetch_array($rez)){
                $selectIme = $red['ime'];
                $selectPrezime = $red['prezime'];
                if($selectIme == $ime && $selectPrezime == $prezime){
                    $upit = "Delete From $imeKlase Where ime = '$ime' and prezime = '$prezime'";
                    mysqli_query($dbc,$upit);
                    echo "<h1 class='row mx-5 mb-3'>Uspesno ste se izbrisali prijavu leta!</h1>";
                    echo "<a class='row btn btn-light mx-5 mb-3' href='index.php'>Vrati se na pocetak</a>";
                    return;
                }
            }

            echo "<h1 class='row mx-5 mb-3'>Brisanje nije moguce, s'obzirom da se u bazi ne nalazi putnik sa zadatim kredencijalima!</h1>";
            echo "<a class='row btn btn-light mx-5 mb-3' href='index.php'>Vrati se na pocetak</a>";
        }

        public static function azurirajBazu($imeKlase,$ime,$prezime,$dest,$avioKomp){
            $dbc = self::povezivanjeSaBazomPodataka();

            $selectUpit = "Select ime,prezime From ".Putnik::vratiImeKlase();
            $rez = mysqli_query($dbc,$selectUpit);

            while ($red = mysqli_fetch_array($rez)){
                $selectIme = $red['ime'];
                $selectPrezime = $red['prezime'];
                if($selectIme == $ime && $selectPrezime == $prezime){
                    $upit = "Update $imeKlase Set sifraDestinacija = $dest, sifraAvioKompanija = $avioKomp Where ime = '$ime' and prezime = '$prezime'";
                    mysqli_query($dbc,$upit);
                    echo "<h1 class='row mx-5 mb-3'>Uspesno ste se promenili prijavu leta!</h1>";
                    echo "<a class='row btn btn-light mx-5 mb-3' href='index.php'>Vrati se na pocetak</a>";
                    return;
                }
            }


            echo "<h1 class='row mx-5 mb-3'>Azuriranje nije moguce, s'obzirom da se u bazi ne nalazi putnik sa zadatim kredencijalima!</h1>";
            echo "<a class='row btn btn-light mx-5 mb-3' href='index.php'>Vrati se na pocetak</a>";

        }

        public static function zatvoriKonekciju($dbc){
            mysqli_close( $dbc);
        }
    }

 ?>