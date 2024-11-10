<?php
$url = 'http://carlo4664.c44.integrator.host:10504/funcionarios/findAll';
$response = file_get_contents($url);

$processos_view = [];
if ($response !== FALSE) {
    $processos_view = json_decode($response, true);
}
?>