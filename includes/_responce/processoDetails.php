
<h1>‎ </h1>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12">

            
        <div class="card-2 mb-3">
                <div class="card-2">
                    <div class="card-2 p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                            <h5 class="text-white text-capitalize ps-3"> Detalhes do Processo</h5>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <p><strong>Código:</strong> <?php echo htmlspecialchars($processo['codigo']); ?></p>
                    <p><strong>Data:</strong> <?php echo htmlspecialchars($processo['data']); ?></p>
                    <p><strong>Hora:</strong> <?php echo htmlspecialchars($processo['hora']); ?></p>
                    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($processo['documentoProcessos']['tipo']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($processo['documentoProcessos']['status']); ?></p>
                    <p><strong>Descrição:</strong> <?php echo htmlspecialchars($processo['documentoProcessos']['descrisao']); ?>
                    </p>
                    <?php if (htmlspecialchars($processo['documentoProcessos']['status']) == 'Aberto') { 
                        $user = $_SESSION['user'];
                        if($user['perfil']['id'] == 1){?>
                        <form class="center" action="../includes/_scripts/repository/processos/update.php" method="POST">
                            <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($processo['codigo']); ?>">
                            <input type="hidden" name="documentoProcessos_id"
                                value="<?php echo htmlspecialchars($processo['documentoProcessos']['id']); ?>">
                            <button type="submit" name="status" value="Concluído" class="btn btn-success">processo
                                Concluído</button>
                            <button type="submit" name="status" value="Perdido" class="btn btn-danger">Processo
                                Perdido</button>
                        </form>
                    <?php }
                        } ?>
                </div>

            </div>



            <div class="card-2 mb-3">
                <div class="card-2">
                    <div class="card-2 p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                            <h6 class="text-white text-capitalize ps-3">Funcionário Responsável</h6>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> <?php echo htmlspecialchars($processo['funcionarios']['nome']); ?></p>
                    <p><strong>Telefone:</strong> <?php echo htmlspecialchars($processo['funcionarios']['telefone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($processo['funcionarios']['email']); ?></p>
                    <p><strong>OAB:</strong> <?php echo htmlspecialchars($processo['funcionarios']['oab']); ?></p>
                    <p><strong>Perfil:</strong> <?php echo htmlspecialchars($processo['funcionarios']['perfil']['nome']); ?></p>
                </div>
            </div>


            <div class="card-2 mb-3">
                <div class="card-2">
                    <div class="card-2 p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                            <h6 class="text-white text-capitalize ps-3">Cliente</h6>
                        </div>
                    </div>
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


            <div class="card-2 mb-3">
                <div class="card-2">
                    <div class="card-2 p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                            <h6 class="text-white text-capitalize ps-3">Documentos do Cliente</h6>
                        </div>
                    </div>

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
        </div>
       
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('myForm').onsubmit = async function (event) {
                event.preventDefault();
                const formData = new FormData(this);

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData
                    });

                    // Verifica se a resposta é JSON
                    const result = await response.json();

                    Swal.fire({
                        icon: result.status === 'success' ? 'success' : 'error',
                        title: result.status === 'success' ? 'Sucesso!' : 'Erro!',
                        text: result.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'dashboard.php?r=acompanhamento';
                        }
                    });
                } catch (error) {
                    console.error('Erro ao processar o formulário:', error);
                }
            }
        </script>