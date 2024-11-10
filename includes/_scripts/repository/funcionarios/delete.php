<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];
        $url = "http://carlo4664.c44.integrator.host:10504/funcionarios/delete/$id";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200 || $httpCode == 204) {
            echo json_encode(['status' => 'success', 'message' => 'Funcionario excluído com sucesso!']);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Não foi possível excluir o funcionario. Tente novamente.',
                'httpCode' => $httpCode,
                'response' => $response
            ]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID não fornecido.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
}
