<?php
function uploadToImgur($filePath) {
    $clientId = 'd3cf9dd6e015588'; 
    $imageData = file_get_contents($filePath);
    $base64 = base64_encode($imageData);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.imgur.com/3/image");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Client-ID $clientId"));
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => $base64));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['data']['link'] ?? null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $linkRg = uploadToImgur($_FILES['linkRg']['tmp_name']);
    $linkResidencia = uploadToImgur($_FILES['linkResidencia']['tmp_name']);
    $linkEstadoCivil = uploadToImgur($_FILES['linkEstadoCivil']['tmp_name']);

    $linkProvas = [];
    foreach ($_FILES['linkProvas']['tmp_name'] as $file) {
        $link = uploadToImgur($file);
        if ($link) {
            $linkProvas[] = $link;
        }
    }


    $documentosClientesData = [
        "linkRg" => $linkRg,
        "linkResidencia" => $linkResidencia,
        "linkEstadoCivil" => $linkEstadoCivil,
        "linkProvas" => $linkProvas
    ];

    $documentosClientesResponse = file_get_contents("http://localhost:30514/documentos/clientes/save", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n",
            "content" => json_encode($documentosClientesData)
        ]
    ]));

    $documentosClientes = json_decode($documentosClientesResponse, true);
    $documentosClientesId = $documentosClientes['id'] ?? null;

    $documentoProcessosData = [
        "tipo" => $_POST['tipo'],
        "status" => "aberto",
        "descrisao" => $_POST['descricao'],
        "documentosClientes" => ["id" => $documentosClientesId]
    ];

    $documentoProcessosResponse = file_get_contents("http://localhost:30514/documentos/processos/save", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n",
            "content" => json_encode($documentoProcessosData)
        ]
    ]));

    $documentoProcessos = json_decode($documentoProcessosResponse, true);
    $documentoProcessosId = $documentoProcessos['id'] ?? null;


    $processoData = [
        "codigo" => strtoupper("AD" . uniqid()),
        "data" => $_POST['data'],
        "hora" => $_POST['hora'],
        "funcionarios" => ["id" => $_POST['funcionario']],
        "clientes" => ["id" => $_POST['clientes']],
        "documentoProcessos" => ["id" => $documentoProcessosId]
    ];

    $processoResponse = file_get_contents("http://localhost:30514/processos/save", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n",
            "content" => json_encode($processoData)
        ]
    ]));

    $result = json_decode($processoResponse, true);

    if (isset($result['id'])) {
        echo json_encode(["status" => "success", "message" => "Processo cadastrado com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao cadastrar o processo."]);
    }
}
?>
