<?php
header('Content-Type: application/json');

$url = 'http://localhost:30514/processos/findAll';

$response = @file_get_contents($url);

if ($response === FALSE) {
    
    echo json_encode(['error' => 'Erro ao buscar processos']);
    exit;
}

$processos = json_decode($response, true);

$events = [];

if (is_array($processos)) {
    foreach ($processos as $processo) {
       
        $startDateTime = $processo['data'] . 'T' . $processo['hora'] . ':00';

        $events[] = [
            'title' => $processo['clientes']['nome'], 
            'start' => $startDateTime,
            'allDay' => false,
            'codigo' => $processo['codigo']
        ];
    }
}

echo json_encode($events);
?>
