<?php
$url = 'http://carlo4664.c44.integrator.host:10504/clientes/findAll';
$response = file_get_contents($url);

$funcionarios = [];
if ($response !== FALSE) {
    $funcionarios = json_decode($response, true);
}

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
                            <?php if (is_array($funcionarios)): ?>
                                <?php foreach ($funcionarios as $funcionario): ?>
                                    <tr>
                                        <td>
                                            <a
                                                href="dashboard.php?r=tarefas" method="POST"> 
                                                <?php echo htmlspecialchars($funcionario['nome']); ?>
                                            </a>
                                        </td>
                                        <td><?php echo htmlspecialchars($funcionario['telefoneCelular']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['cpf']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['email']); ?></td>
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
include("includes/_scripts/processosEncontrados.php");
?>