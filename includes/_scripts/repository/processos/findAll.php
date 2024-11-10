<?php
header('Content-Type: application/json');

$url = 'http://carlo4664.c44.integrator.host:10504/processos/findAll';

$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(['error' => 'Erro ao buscar processos']);
    exit;
}

$processos = json_decode($response, true);

if ($processos === null) {
    echo json_encode(['error' => 'Erro ao decodificar JSON']);
    exit;
}


$events = [];

if (is_array($processos)) {
    foreach ($processos as $processo) {
        if (isset($processo['documentoProcessos']['status']) && $processo['documentoProcessos']['status'] == 'Aberto') {

            $startDateTime = isset($processo['data'], $processo['hora']) ? $processo['data'] . 'T' . $processo['hora'] . ':00' : null;

            $events[] = [
                'title' => isset($processo['clientes']['nome']) ? $processo['clientes']['nome'] : 'Nome Indisponível',
                'start' => $startDateTime,
                'allDay' => false,
                'codigo' => isset($processo['codigo']) ? $processo['codigo'] : 'Código Indisponível'
            ];
        }
    }
}

echo json_encode($events);
?>
