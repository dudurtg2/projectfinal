<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $status = $_POST['status'];
    $documentoProcessos_id = $_POST['documentoProcessos_id'];

    $url_get = "http://carlo4664.c44.integrator.host:10504/documentos/processos/findById/" . urlencode($documentoProcessos_id);
    $response_get = file_get_contents($url_get);

    if ($response_get === FALSE) {
        echo "<script>
                window.onload = function() {
                    Swal.fire('Erro!', 'Erro ao buscar dados do DocumentoProcessos.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../pages/dashboard.php?r=acompanhamento&codigo=" . $codigo . "';
                        }
                    });
                };
              </script>";
        exit;
    }

    $documentoProcessos = json_decode($response_get, true);

    if (!$documentoProcessos) {
        echo "<script>
                window.onload = function() {
                    Swal.fire('Erro!', 'Documento não encontrado.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../pages/dashboard.php?r=acompanhamento&codigo=" . $codigo . "';
                        }
                    });
                };
              </script>";
        exit;
    }

    $data = [
        'id' => $documentoProcessos['id'],
        'tipo' => $documentoProcessos['tipo'],
        'status' => $status,
        'descrisao' => $documentoProcessos['descrisao'],
        'documentosClientes' => $documentoProcessos['documentosClientes'],
    ];

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

    if ($httpCode == 200) {
        echo "<script>
                window.onload = function() {
                    Swal.fire('Sucesso!', 'Status do processo atualizado com sucesso!', 'success').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../pages/dashboard.php?r=acompanhamento&codigo=" . $codigo . "';
                        }
                    });
                };
              </script>";
    } else {
        echo "<script>
                window.onload = function() {
                    Swal.fire('Erro!', 'Erro ao atualizar status. Tente novamente.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../pages/dashboard.php?r=acompanhamento&codigo=" . $codigo . "';
                        }
                    });
                };
              </script>";
    }
} else {
    echo "<script>
            window.onload = function() {
                Swal.fire('Erro!', 'Método de requisição inválido.', 'error').then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../../../../pages/dashboard.php?r=acompanhamento&codigo=" . $codigo . "';
                        }
                    });
            };
          </script>";
}
?>
