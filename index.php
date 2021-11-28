<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projekat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head
<body>

<?php

require_once "connect_vars.php";
require_once "broker_baze_podataka.php";

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-lg-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Magna Air</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-lg">
    <form action="" method="post" name="prijava">
        <div class="row row-cols-2 justify-content-between">

            <label for="ime mb-1">Ime</label>

            <label for="prezime mb-1">Prezime</label>

            <div class="col-md-6 mb-2">
                <input type="text" name="ime" id="ime">
            </div>
            <div class="col-md-6 mb-2">
                <input type="text" name="prezime" id="prezime">
            </div>


            <div class="col-md-6 mb-4">
                <label for="destinacija">Destinacija</label>
                <select class="form-select" aria-label="Default select example" id="destinacija" name="destinacija">
                    <option selected></option>
                    <?php
                    $dbc = Broker::povezivanjeSaBazomPodataka();
                    $rezultat = Broker::prikaziIzBaze(Destinacija::vratiImeKlase());


                    while ($red = mysqli_fetch_array($rezultat)){
                        $naziv = $red['naziv'];
                        $sifra = $red['sifraDestinacija'];
                        echo "<option value='$sifra' >$naziv</option>";
                    }

                    Broker::zatvoriKonekciju($dbc);
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="avio">Avio kompanija</label>
                <select class="form-select" aria-label="Default select example" id="avio" name="avio_kompanija">
                    <option selected></option>
                    <?php
                    $dbc = Broker::povezivanjeSaBazomPodataka();
                    $rezultat = Broker::prikaziIzBaze(AvioKompanija::vratiImeKlase());


                    while ($red = mysqli_fetch_array($rezultat)){
                        $naziv = $red['naziv'];
                        $id = $red['sifraAvioKompanija'];
                        echo "<option value='$id'>$naziv</option>";
                    }
                    Broker::zatvoriKonekciju($dbc);
                    ?>
                </select>
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-6 d-flex flex-row-reverse">
                <input type="submit" class="btn btn-danger" name="submit" value="Obrisi"/>
                <input type="submit" class="btn btn-secondary mx-2" name="submit" value="Izmeni">
                <input class="btn btn-primary align-self-end" type="submit" name="submit" value="Prijavi se"/>

            </div>
        </div>
    </form>
</div>

<script src="js-projekat/main.js"></script>
<?php

if(isset($_POST['submit']) && $_POST['submit'] == "Prijavi se"){


    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $destinacija = $_POST['destinacija'];
    $avioKomp = $_POST['avio_kompanija'];

    $dbc = Broker::povezivanjeSaBazomPodataka();
    Broker::ubaciUBazu(Putnik::vratiImeKlase(),$ime,$prezime,$destinacija,$avioKomp);
    Broker::zatvoriKonekciju($dbc);
    echo "<h1>Uspesno ste se prijavili za let!</h1>";
    echo "<a class='btn btn-light' href='index.php'>Vrati se na pocetak</a>";
}

if(isset($_POST['submit']) && $_POST['submit'] == "Obrisi"){


    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    $dbc = Broker::povezivanjeSaBazomPodataka();
    Broker::izbaciIzBaze(Putnik::vratiImeKlase(),$ime,$prezime);
    Broker::zatvoriKonekciju($dbc);
    echo "<h1>Uspesno ste se obrisali prijavu leta!</h1>";
    echo "<a class='btn btn-light' href='index.php'>Vrati se na pocetak</a>";
}


if(isset($_POST['submit']) && $_POST['submit'] == "Izmeni"){


    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $destinacija = $_POST['destinacija'];
    $avioKomp = $_POST['avio_kompanija'];

    $dbc = Broker::povezivanjeSaBazomPodataka();
    Broker::azurirajBazu(Putnik::vratiImeKlase(),$ime,$prezime,$destinacija,$avioKomp);
    Broker::zatvoriKonekciju($dbc);
    echo "<h1>Uspesno ste se promenili prijavu leta!</h1>";
    echo "<a class='btn btn-light' href='index.php'>Vrati se na pocetak</a>";
}


?>
</body>
</html>
