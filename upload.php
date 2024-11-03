<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploads = [];

    // Processa o upload de cada arquivo individual
    $fields = ['linkRg', 'linkResidencia', 'linkEstadoCivil'];
    
    foreach ($fields as $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $uploads[$field] = uploadToImgur($_FILES[$field]);
        } else {
            echo "Erro ao enviar o arquivo: " . $_FILES[$field]['error'] . "<br>";
        }
    }

    // Processa o upload dos arquivos múltiplos
    if (isset($_FILES['linkProvas'])) {
        $uploads['linkProvas'] = [];
        foreach ($_FILES['linkProvas']['name'] as $key => $name) {
            if ($_FILES['linkProvas']['error'][$key] === UPLOAD_ERR_OK) {
                $uploads['linkProvas'][] = uploadToImgur([
                    'name' => $name,
                    'tmp_name' => $_FILES['linkProvas']['tmp_name'][$key],
                    'error' => $_FILES['linkProvas']['error'][$key]
                ]);
            } else {
                echo "Erro ao enviar a prova: " . $_FILES['linkProvas']['error'][$key] . "<br>";
            }
        }
    }

    // Salvar os links no endpoint
    saveLinks($uploads);

    // Exibir as imagens na tela
    displayImages($uploads);
}

// Função para fazer o upload de um arquivo para o Imgur
function uploadToImgur($file) {
    $clientId = 'd3cf9dd6e015588'; // Substitua pelo seu Client ID do Imgur
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.imgur.com/3/image");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $clientId));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Cria um arquivo temporário para o upload
    $data = [
        'image' => base64_encode(file_get_contents($file['tmp_name'])),
        'type' => 'base64',
    ];
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    // Executa o cURL
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decodifica a resposta
    $result = json_decode($response, true);
    
    // Verifica se o upload foi bem-sucedido
    if (isset($result['data']['link'])) {
        return $result['data']['link']; // Retorna o link da imagem
    } else {
        return "Erro ao enviar a imagem: " . $result['data']['error'];
    }
}

// Função para salvar os links no endpoint
function saveLinks($uploads) {
    $url = "http://localhost:30514/documentos/clientes/save";

    // Cria o corpo da requisição
    $data = json_encode([
        'linkRg' => $uploads['linkRg'] ?? null,
        'linkResidencia' => $uploads['linkResidencia'] ?? null,
        'linkEstadoCivil' => $uploads['linkEstadoCivil'] ?? null,
        'linkProvas' => $uploads['linkProvas'] ?? []
    ]);

    // Inicializa o cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ]);

    // Executa a requisição
    $response = curl_exec($ch);
    curl_close($ch);
}

// Função para exibir as imagens
function displayImages($uploads) {
    echo "<h3>Imagens Enviadas:</h3>";
    echo "<div class='row'>";
    
    // Exibe a imagem do RG
    if (isset($uploads['linkRg'])) {
        echo "<div class='col'><h4>RG:</h4><img src='{$uploads['linkRg']}' alt='RG' style='max-width: 100%; height: auto;'/></div>";
    }
    
    // Exibe a imagem do Comprovante de Residência
    if (isset($uploads['linkResidencia'])) {
        echo "<div class='col'><h4>Comprovante de Residência:</h4><img src='{$uploads['linkResidencia']}' alt='Comprovante de Residência' style='max-width: 100%; height: auto;'/></div>";
    }
    
    // Exibe a imagem do Estado Civil
    if (isset($uploads['linkEstadoCivil'])) {
        echo "<div class='col'><h4>Estado Civil:</h4><img src='{$uploads['linkEstadoCivil']}' alt='Estado Civil' style='max-width: 100%; height: auto;'/></div>";
    }
    
    // Exibe as provas
    if (isset($uploads['linkProvas'])) {
        foreach ($uploads['linkProvas'] as $prova) {
            echo "<div class='col'><h4>Prova:</h4><img src='$prova' alt='Prova' style='max-width: 100%; height: auto;'/></div>";
        }
    }
    
    echo "</div>";
}
?>
