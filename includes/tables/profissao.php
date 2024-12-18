<?php
include("../includes/_scripts/repository/profissao/findAll.php");
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-2">
                <div class="card-header p-2 ps-3">
                    <div
                        class="card-4 shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Lista de Cargos</h6>
                    </div>

                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>Cargos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($processos_view)): ?>
                                <?php foreach ($processos_view as $processo): ?>
                                    <tr>
                                        <td>
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <span><?php echo htmlspecialchars($processo['nome']); ?></span>
                                                <button class="btn btn-danger btn-sm delete-btn"
                                                    data-id="<?php echo $processo['id']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Nenhum funcionário encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('../includes/_scripts/repository/profissao/delete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: id })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire(
                                    'Excluído!',
                                    'O cargo foi excluído com sucesso.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Erro!',
                                    data.message || 'Não foi possível excluir o cargo. Tente novamente.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Erro!',
                                'Ocorreu um erro ao processar a solicitação.',
                                'error'
                            );
                            console.error('Erro:', error);
                        });
                }
            });
        });
    });
</script>
