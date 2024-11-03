<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] . ' ' . $_POST['sobrenome'];
    $data = array(
        'nome' => $nome,
        'email' => $_POST['email'],
        'telefone' => $_POST['phone'],
        'senha' => md5($_POST['password']),
        'cpf' => $_POST['cpf'],
        'oab' => $_POST['oab'] ?? null,
        'perfil' => array('id' => $_POST['profession'])
    );

    $jsonData = json_encode($data);
    $url = 'http://localhost:30514/funcionarios/save';
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
        echo json_encode(array('status' => 'success', 'message' => 'Registro cadastrado com sucesso!'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Dados incorretos. Tente novamente.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Método de requisição inválido.'));
}
?>
