<?php
session_start();
header('Content-Type: application/json');
?>
<?php include './findAll.php'; ?>
<?php
if (is_array($funcionarios)) {
    foreach ($funcionarios as $funcionario) {
        if (
            $funcionario['email'] == $_POST['email'] or
            $funcionario['cpf'] == $_POST['cpf'] or
            $funcionario['telefone'] == $_POST['phone'] or
            $funcionario['oab'] == $_POST['oab']
        ) {
            echo json_encode(array('status' => 'error', 'message' => 'Dados ja cadastrados. Tente novamente.'));
            exit;
        }
    }
} 
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
        $url = 'http://carlo4664.c44.integrator.host:10504/funcionarios/save';
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