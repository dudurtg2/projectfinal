<?php
session_start();
header('Content-Type: application/json');
?>
<?php include './findAll.php'; ?>
<?php
if (is_array($clientes)) {
    foreach ($clientes as $cliente) {
        if (
            $cliente['cpf'] == $_POST['cpf'] or
            $cliente['telefoneCelular'] == $_POST['telefone'] or
            $cliente['email'] == $_POST['emailaaaa']
        ) {
            echo json_encode(array('status' => 'error', 'message' => 'Dados ja cadastrados. Tente novamente.'));
            exit;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] . ' ' . $_POST['sobrenome'];

    $clienteData = array(
        'nome' => $nome,
        'cpf' => $_POST['cpf'],
        'nascionalidade' => $_POST['nascionalidade'],
        'estadoCivil' => $_POST['estadoCivil'],
        'proficao' => $_POST['proficao'],
        'endereco' => $_POST['endereco'],
        'dataNascimento' => $_POST['dataNascimento'],
        'telefoneFixo' => $_POST['telefoneFixo'],
        'telefoneCelular' => $_POST['telefone'],
        'email' => $_POST['emailaaaa']
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