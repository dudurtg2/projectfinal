<?php

$url = 'http://carlo4664.c44.integrator.host:10504/funcionarios/findAll';
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
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="tag-tittle shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Funcionários Cadastrados</h6>
                        </div>
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
                            <?php if (is_array($funcionarios)): ?>
                                <?php foreach ($funcionarios as $funcionario): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['perfil']['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($funcionario['telefone']); ?></td>
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