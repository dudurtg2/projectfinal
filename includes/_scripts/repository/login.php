<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // MD5 da senha fornecida

    $url = "http://carlo4664.c44.integrator.host:10504/funcionarios/findByEmail/" . urlencode($email);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    if ($response === false) {
        echo "Erro ao buscar usuário: " . curl_error($ch);
        exit;
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data)) {
        $user = $data; 
        $storedPassword = $user['senha']; 

        if ($password === $storedPassword) {
            $_SESSION['user'] = $user; 
            header("Location: /material-dashboard/dashboard.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Senha incorreta!";
            header("Location: /material-dashboard/login.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Email não encontrado!";
        header("Location: /material-dashboard/login.php");
        exit;
    }
}
?>
