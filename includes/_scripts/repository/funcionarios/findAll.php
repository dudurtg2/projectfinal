<?php
$url = 'http://carlo4664.c44.integrator.host:10504/funcionarios/findAll';
$response = file_get_contents($url);

$funcionarios = [];
if ($response !== FALSE) {
    $funcionarios = json_decode($response, true);
}
?>