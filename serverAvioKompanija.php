<?php

require_once "broker_baze_podataka.php";

$dbc = Broker::povezivanjeSaBazomPodataka();
$pom = Broker::prikaziIzBaze(AvioKompanija::vratiImeKlase());
$rezultatAvioKompanijaJSON = mysqli_fetch_all($pom,MYSQLI_ASSOC);

exit(json_encode($rezultatAvioKompanijaJSON));
?>