<?php

header('Content-Type: application/json');
?>
<?php include './findAll.php'; ?>
<?php
if (is_array($processos_view)) {
    foreach ($processos_view as $perfil) {
        if (
            $perfil['nome'] == $_POST['inputNomeProfissao']
        ) {
            echo json_encode(array('status' => 'error', 'message' => 'Dados ja cadastrados. Tente novamente.'));
            exit;
        }
    }
} 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $clienteData = array(
        'nome' => $_POST['inputNomeProfissao'] // Corrigido: removido o segundo $
    );

    $jsonData = json_encode($clienteData);
    
    $url = 'http://carlo4664.c44.integrator.host:10504/perfis/save';
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 201) {
        echo json_encode(array('status' => 'success', 'message' => 'Cliente cadastrado com sucesso!'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Erro no cadastro. Tente novamente.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Método de requisição inválido.'));
}
?>
