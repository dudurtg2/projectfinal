<?php

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $url = "http://carlo4664.c44.integrator.host:10504/processos/findByCodigo/" . urlencode($codigo);
    $response = file_get_contents($url);

    $processo = [];
    if ($response !== FALSE) {
        $processo = json_decode($response, true);
        include "../includes/_responce/processoDetails.php";
        include "../includes/tables/processos.php";
    } else {
        echo "<p>Erro ao buscar dados do processo.</p>";
        include "../includes/tables/processos.php";
    }
} else {
    include "../includes/tables/processos.php";
}
?>