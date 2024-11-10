
<?php
include("../includes/_scripts/repository/funcionarios/findAll.php");
?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-2">
                <div class="card-header p-2 ps-3">
                    <div
                        class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Funcionários Cadastrados</h6>
                    </div>


                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Profissão</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($processos_view)): ?>
                                <?php foreach ($processos_view as $processo): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($processo['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($processo['perfil']['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($processo['telefone']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Nenhum funcionário encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>