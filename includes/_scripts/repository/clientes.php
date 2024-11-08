<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] . ' ' . $_POST['sobrenome'];
    
    $clienteData = array(
        'nome' => $nome,
        'cpf' => $_POST['cpf'],
        'nacionalidade' => $_POST['nascionalidade'],
        'estado_civil' => $_POST['estado_civil'],
        'profissao' => $_POST['profissao'],
        'endereco' => $_POST['endereco'],
        'data_nascimento' => $_POST['data_nascimento'],
        'telefone_fixo' => $_POST['telefone_fixo'],
        'telefone_celular' => $POST['telefone_celular'],
        'email' => $POST['email']
    );

    $jsonData = json_encode($clienteData);
    
    $url = 'http://carlo4664.c44.integrator.host:10504/clientes/save';
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
