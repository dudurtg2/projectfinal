<?php 
$url = 'http://localhost:30514/processos/findAll';
$response = file_get_contents($url);

$funcionarios = [];
if ($response !== FALSE) {
    $funcionarios = json_decode($response, true);
}
?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <h5>Lista de Cadastrados de Processos</h5>
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Codigo de processo</th>
                                <th>Funcionario</th>
                                <th>Clientes</th>
                                <th>Data</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($funcionarios)): ?>
                                <?php foreach ($funcionarios as $funcionario): ?>
                                    <tr>
                                        <td>
                                            <a
                                                href="dashboard.php?r=acompanhamento&codigo=<?php echo urlencode($funcionario['codigo']); ?>">
                                                <?php echo htmlspecialchars($funcionario['codigo']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($funcionario['funcionarios']['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['clientes']['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['data']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['hora']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">Nenhum funcionário encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>