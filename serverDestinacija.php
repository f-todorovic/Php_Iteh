<?php
require_once "broker_baze_podataka.php";


$dbc = Broker::povezivanjeSaBazomPodataka();
$i = Broker::prikaziIzBaze(Destinacija::vratiImeKlase());
$rezultat = mysqli_fetch_all($i,MYSQLI_ASSOC);

exit(json_encode($rezultat));?>