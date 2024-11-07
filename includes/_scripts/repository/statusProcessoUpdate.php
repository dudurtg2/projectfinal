<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se 'codigo' e 'status' foram passados
    if (isset($_POST['codigo']) && isset($_POST['status'])) {
        $codigo = $_POST['codigo'];
        $status = $_POST['status'] === 'ganho' ? 'Ganho' : 'Não Ganho';  // Definindo status

        // Verifica se o código e o status não estão vazios
        if (empty($codigo) || empty($status)) {
            echo json_encode(array('status' => 'error', 'message' => 'Código ou Status ausente.'));
            exit;
        }

        // URL para buscar o processo por código
        $url = "http://carlo4664.c44.integrator.host:10504/processos/findByCodigo/" . urlencode($codigo);
        
        // Faz a requisição GET para buscar o processo
        $response = file_get_contents($url);
        
        if ($response !== FALSE) {
            // Decodifica a resposta JSON para obter o processo
            $processo = json_decode($response, true);
            
            // Verifica se o processo foi encontrado
            if (isset($processo['id'])) {
                // Obtém o ID do processo
                $id = $processo['id'];

                // URL para atualizar o processo
                $updateUrl = "http://carlo4664.c44.integrator.host:10504/processos/update/" . urlencode($id);

                // Dados para atualização (atualiza apenas o status)
                $data = [
                    'status' => $status
                ];

                // Inicia o cURL para fazer o PUT
                $ch = curl_init();

                // Configuração do cURL
                curl_setopt($ch, CURLOPT_URL, $updateUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Envia os dados como JSON
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-Type: application/json",
                    "Accept: application/json"
                ]);

                // Executa a requisição e captura a resposta
                $result = curl_exec($ch);

                // Verifica se ocorreu algum erro com o cURL
                if (curl_errno($ch)) {
                    echo json_encode(array('status' => 'error', 'message' => 'Erro ao fazer a requisição: ' . curl_error($ch)));
                } else {
                    // Verifica a resposta da requisição de atualização
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if ($httpCode == 200) {
                        echo json_encode(array('status' => 'success', 'message' => 'Status do processo atualizado com sucesso!'));
                    } else {
                        echo json_encode(array('status' => 'error', 'message' => 'Erro ao atualizar o status do processo. HTTP Code: ' . $httpCode));
                    }
                }

                // Fecha a sessão cURL
                curl_close($ch);
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Processo não encontrado.'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Erro ao buscar o processo.'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Parâmetros ausentes.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Método de requisição inválido.'));
}
?>
