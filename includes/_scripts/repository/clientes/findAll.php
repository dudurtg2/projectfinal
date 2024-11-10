<?php
$url = 'http://carlo4664.c44.integrator.host:10504/clientes/findAll';
$response = file_get_contents($url);

$clientes = [];
if ($response !== FALSE) {
    $clientes = json_decode($response, true);
}

?>
