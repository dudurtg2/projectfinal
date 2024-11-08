<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $status = $_POST['status'];
    $documentoProcessos_id = $_POST['documentoProcessos_id'];

    // URL de consulta dos dados
    $url_get = "http://carlo4664.c44.integrator.host:10504/documentos/processos/findById/" . urlencode($documentoProcessos_id);
    $response_get = file_get_contents($url_get);

    if ($response_get === FALSE) {
        // Se não conseguir buscar os dados, retorna erro
        echo "<script>
                window.onload = function() {
                    Swal.fire('Erro!', 'Erro ao buscar dados do DocumentoProcessos.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../dashboard.php?r=acompanhamento';
                        }
                    });
                };
              </script>";
        exit;
    }

    $documentoProcessos = json_decode($response_get, true);

    if (!$documentoProcessos) {
        // Caso não encontre o documento, retorna erro
        echo "<script>
                window.onload = function() {
                    Swal.fire('Erro!', 'Documento não encontrado.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../dashboard.php?r=acompanhamento';
                        }
                    });
                };
              </script>";
        exit;
    }

    // Dados que serão atualizados
    $data = [
        'id' => $documentoProcessos['id'],
        'tipo' => $documentoProcessos['tipo'],
        'status' => $status,
        'descrisao' => $documentoProcessos['descrisao'],
        'documentosClientes' => $documentoProcessos['documentosClientes'],
    ];

    // URL de atualização do status
    $url_put = "http://carlo4664.c44.integrator.host:10504/documentos/processos/update/" . urlencode($documentoProcessos_id);

    $ch = curl_init($url_put);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verifica o código de status da resposta HTTP
    if ($httpCode == 200) {
        // Caso a atualização seja bem-sucedida, exibe a mensagem de sucesso
        echo "<script>
                window.onload = function() {
                    Swal.fire('Sucesso!', 'Status do processo atualizado com sucesso!', 'success').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../dashboard.php?r=acompanhamento';
                        }
                    });
                };
              </script>";
    } else {
        // Caso ocorra algum erro durante a atualização, exibe erro
        echo "<script>
                window.onload = function() {
                    Swal.fire('Erro!', 'Erro ao atualizar status. Tente novamente.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../dashboard.php?r=acompanhamento';
                        }
                    });
                };
              </script>";
    }
} else {
    // Se o método de requisição não for POST, exibe um erro
    echo "<script>
            window.onload = function() {
                Swal.fire('Erro!', 'Método de requisição inválido.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../dashboard.php?r=acompanhamento';
                        }
                    });
            };
          </script>";
}
?>