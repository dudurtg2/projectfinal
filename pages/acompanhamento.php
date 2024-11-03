<?php
// Verifica se o parâmetro 'codigo' está presente na URL
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // URL da API para buscar o processo pelo código
    $url = "http://localhost:30514/processos/findByCodigo/" . urlencode($codigo);
    $response = file_get_contents($url);

    // Decodifica a resposta JSON da API
    $processo = [];
    if ($response !== FALSE) {
        $processo = json_decode($response, true);
        ?>
        <div class="container py-4">
            <h2 class="mb-4">Detalhes do Processo</h2>

            <!-- Informações do Processo -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Processo</h5>
                </div>
                <div class="card-body">
                    <p><strong>Código:</strong> <?php echo htmlspecialchars($processo['codigo']); ?></p>
                    <p><strong>Data:</strong> <?php echo htmlspecialchars($processo['data']); ?></p>
                    <p><strong>Hora:</strong> <?php echo htmlspecialchars($processo['hora']); ?></p>
                    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($processo['documentoProcessos']['tipo']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($processo['documentoProcessos']['status']); ?></p>
                    <p><strong>Descrição:</strong> <?php echo htmlspecialchars($processo['documentoProcessos']['descrisao']); ?>
                    </p>
                </div>
            </div>

            <!-- Informações do Funcionário -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Funcionário Responsável</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($processo['funcionarios']['nome']); ?></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($processo['funcionarios']['telefone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($processo['funcionarios']['email']); ?></p>
                    <p><strong>OAB:</strong> <?php echo htmlspecialchars($processo['funcionarios']['oab']); ?></p>
                    <p><strong>Perfil:</strong> <?php echo htmlspecialchars($processo['funcionarios']['perfil']['nome']); ?></p>
                </div>
            </div>

            <!-- Informações do Cliente -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Cliente</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($processo['clientes']['nome']); ?></p>
                    <p><strong>CPF:</strong> <?php echo htmlspecialchars($processo['clientes']['cpf']); ?></p>
                    <p><strong>Nacionalidade:</strong> <?php echo htmlspecialchars($processo['clientes']['nascionalidade']); ?>
                    </p>
                    <p><strong>Estado Civil:</strong> <?php echo htmlspecialchars($processo['clientes']['estadoCivil']); ?></p>
                    <p><strong>Profissão:</strong> <?php echo htmlspecialchars($processo['clientes']['proficao']); ?></p>
                    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($processo['clientes']['endereco']); ?></p>
                    <p><strong>Data de Nascimento:</strong>
                        <?php echo htmlspecialchars($processo['clientes']['dataNascimento']); ?></p>
                    <p><strong>Telefone Fixo:</strong> <?php echo htmlspecialchars($processo['clientes']['telefoneFixo']); ?>
                    </p>
                    <p><strong>Telefone Celular:</strong>
                        <?php echo htmlspecialchars($processo['clientes']['telefoneCelular']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($processo['clientes']['email']); ?></p>
                </div>
            </div>

            <!-- Documentos do Cliente -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Documentos do Cliente</h5>
                </div>
                <div class="card-body">
                    <p><strong>RG:</strong></p>
                    <img src="<?php echo htmlspecialchars($processo['documentoProcessos']['documentosClientes']['linkRg']); ?>"
                        class="img-fluid mb-2" alt="RG">
                    <p><strong>Comprovante de Residência:</strong></p>
                    <img src="<?php echo htmlspecialchars($processo['documentoProcessos']['documentosClientes']['linkResidencia']); ?>"
                        class="img-fluid mb-2" alt="Residência">
                    <p><strong>Estado Civil:</strong></p>
                    <img src="<?php echo htmlspecialchars($processo['documentoProcessos']['documentosClientes']['linkEstadoCivil']); ?>"
                        class="img-fluid mb-2" alt="Estado Civil">
                    <p><strong>Provas:</strong></p>
                    <div class="row">
                        <?php foreach ($processo['documentoProcessos']['documentosClientes']['linkProvas'] as $linkProva): ?>
                            <div class="col-md-4 mb-2">
                                <img src="<?php echo htmlspecialchars($linkProva); ?>" class="img-fluid" alt="Prova">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "includes/table_processos.php";
    } else {
        echo "<p>Erro ao buscar dados do processo.</p>";
        include "includes/table_processos.php";
    }
} else {
    include "includes/table_processos.php";
}
?>