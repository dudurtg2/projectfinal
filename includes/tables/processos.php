<?php
include("../includes/_scripts/repository/processos/findAllTable.php");
?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-2">
                <div class="card-header p-2 ps-3">

                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">

                        <h6 class="text-white text-capitalize ps-3">Lista de Cadastrados de Processos</h6>
                    </div>

                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Codigo de processo</th>
                                <th>Funcionario</th>
                                <th>Clientes</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($processos_view)): ?>
                                <?php foreach ($processos_view as $processo): ?>
                                    <tr>
                                        <td>
                                            <a
                                                href="dashboard.php?r=acompanhamento&codigo=<?php echo urlencode($processo['codigo']); ?>">
                                                <?php echo htmlspecialchars($processo['codigo']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($processo['funcionarios']['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($processo['clientes']['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($processo['data']); ?></td>
                                        <td><?php echo htmlspecialchars($processo['documentoProcessos']['status']); ?></td>
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