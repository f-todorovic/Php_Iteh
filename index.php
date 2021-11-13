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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    <form action="">
        <div class="row row-cols-2 justify-content-between">

            <label for="ime">Ime</label>

            <label for="prezime">Prezime</label>

            <div class="col-md-6">
                <input type="text" name="ime" id="ime">
            </div>
            <div class="col-md-6">
                <input type="text" name="prezime" id="prezime">
            </div>


            <div class="col-md-6">
                <select class="form-select" aria-label="Default select example">
                    <option selected></option>
                    <?php
                        $dbc = Broker::povezivanjeSaBazomPodataka();
                        $rezultat = Broker::prikaziIzBaze(Destinacija::vratiImeKlase());

                        while ($red = mysqli_fetch_array($rezultat)){
                            $naziv = $red['naziv'];
                            echo "<option value='1'>$naziv</option>";
                        }

                        Broker::zatvoriKonekciju($dbc);
                        ?>
<!--                    <option value="2">One</option>-->
<!--                    <option value="3">Two</option>-->
<!--                    <option value="4">Three</option>-->
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

        </div>
    </form>
</div>
<?php

    require_once "connect_vars.php";
    echo "<h1>Projekat iteh!</h1>";
    echo DB_HOST;

?>



</body>
</html>
