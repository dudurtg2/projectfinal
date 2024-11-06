<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card-2">
                <div class="card-header p-2 ps-3">
                    <h5>Novo Processo</h5>
                    <div>
                        <form id="myForm" class="row g-3" method="post" action="includes/_scripts/repository/processo.php">
                            <div class="col-md-4">
                                <label for="inputData" class="form-label">Data</label>
                                <div class="input-group input-group-outline">
                                    <input type="date" class="form-control" name="data" id="inputData" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="inputHora" class="form-label">Hora</label>
                                <div class="input-group input-group-outline">
                                    <input type="time" class="form-control" name="hora" id="inputHora" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="tipoSelect" class="form-label">Tipo</label>
                                <div class="input-group input-group-outline">
                                    <select class="form-select" name="tipo" id="tipoSelect" required>
                                        <option value="" disabled selected>Selecione o tipo de processo</option>
                                        <option value="Empresario">Empresário</option>
                                        <option value="Civil">Civil</option>
                                        <option value="Penal">Penal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="inputDescricao" class="form-label">Descrição</label>
                                <div class="input-group input-group-outline">
                                    <input type="text" class="form-control" name="descricao" id="inputDescricao"
                                        required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label for="funcionarioSelect" class="form-label">Funcionário</label>
                                <div class="input-group input-group-outline">
                                    <select id="funcionarioSelect" class="form-select" name="funcionario" required>
                                    <option value="" disabled selected>Selecione o funcionário</option>
                                        <?php
                                        $url = 'http://carlo4664.c44.integrator.host:10504/funcionarios/findAll';
                                        $response = file_get_contents($url);
                                        if ($response !== FALSE) {
                                            $data = json_decode($response, true);
                                            if (is_array($data)) {
                                                foreach ($data as $profession) {
                                                    echo '<option value="' . htmlspecialchars($profession['id']) . '">' . htmlspecialchars($profession['nome']) . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option disabled>Erro ao carregar profissões</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="clientesSelect" class="form-label">Clientes</label>
                                <div class="input-group input-group-outline">
                                    <select id="clientesSelect" class="form-select" name="clientes" required>
                                        <option value="" disabled selected>Selecione o clientes</option>
                                        <?php
                                        $url = 'http://carlo4664.c44.integrator.host:10504/clientes/findAll';
                                        $response = file_get_contents($url);
                                        if ($response !== FALSE) {
                                            $data = json_decode($response, true);
                                            if (is_array($data)) {
                                                foreach ($data as $profession) {
                                                    echo '<option value="' . htmlspecialchars($profession['id']) . '">' . htmlspecialchars($profession['nome']) . '</option>';
                                                }
                                            }
                                        } else {
                                            echo '<option disabled>Erro ao carregar profissões</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <h5 class="form-label">Documentos</h5>
                            <div class="container-fluid py-2">
                                <div class="row">
                                    <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
                                        <div class="card-2">
                                            <div class="card-header p-2 ps-3">
                                                <div class="form-group col-md-6">
                                                    <label for="linkRg" class="form-label">RG:</label>
                                                    <input type="file" class="form-control-file" id="linkRg"
                                                        name="linkRg" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="linkResidencia" class="form-label">Comprovante de
                                                        Residência:</label>
                                                    <input type="file" class="form-control-file" id="linkResidencia"
                                                        name="linkResidencia" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="linkEstadoCivil" class="form-label">Estado
                                                        Civil:</label>
                                                    <input type="file" class="form-control-file" id="linkEstadoCivil"
                                                        name="linkEstadoCivil" required>
                                                </div>
                                                <div class="form-group col-md-6" class="form-label">
                                                    <label for="linkProvas">Provas (múltiplas):</label>
                                                    <input type="file" class="form-control-file" id="linkProvas"
                                                        name="linkProvas[]" multiple required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
include "includes/table_processos.php";
?>


<div id="loadingOverlay" style="display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Carregando...</span>
    </div>
</div>
<style>
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('myForm').onsubmit = async function (event) {
        event.preventDefault();

        document.getElementById('loadingOverlay').style.display = 'flex';

        const formData = new FormData(this);

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            document.getElementById('loadingOverlay').style.display = 'none';

            Swal.fire({
                icon: result.status === 'success' ? 'success' : 'error',
                title: result.status === 'success' ? 'Sucesso!' : 'Erro!',
                text: result.message
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = './dashboard.php?r=funcionarios';
                }
            });
        } catch (error) {
            document.getElementById('loadingOverlay').style.display = 'none';

            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Ocorreu um erro ao processar o formulário.'
            });
        }
    }
</script>


<link rel="stylesheet" href="assets/css/custom-styles-min.css">