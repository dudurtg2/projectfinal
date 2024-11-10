<?php
include("../includes/_scripts/repository/clientes/findAll.php");
?>


<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-2">
                <div class="card-header p-2 ps-3">
                <div
                        class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Lista de Cadastrados de Processos</h6>
                    </div>
                    

                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($clientes)): ?>
                                <?php foreach ($clientes as $cliente): ?>
                                    <tr>
                                        <td>
                                            <a
                                                href="dashboard.php?r=tarefas" method="POST"> 
                                                <?php echo htmlspecialchars($cliente['nome']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($cliente['telefoneCelular']); ?></td>
                                        <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
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
<?php
include("../includes/_responce/processos.php");
?>