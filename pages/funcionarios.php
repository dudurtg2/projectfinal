<?php
include "../includes/tables/funcionarios.php";
?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-2">
                <div class="card-header p-2 ps-3">
                    <div
                        class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Cadastradar de Funcionários</h6>
                    </div>
                    <div class="container-fluid py-2">
                        <div class="row">
                            <div>
                                <form id="myForm" class="row g-3" method="post"
                                    action="includes/_scripts/repository/funcionarios/save.php">
                                    <div class="col-md-6">
                                        <label for="inputNome" class="form-label">Nome</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" class="form-control" name="nome" id="inputNome" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputSobrenome" class="form-label">Sobrenome</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" class="form-control" name="sobrenome" id="inputSobrenome"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <div class="input-group input-group-outline">
                                            <input type="email" class="form-control" name="email" id="inputEmail"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputPassword" class="form-label">Senha</label>
                                        <div class="input-group input-group-outline">
                                            <input type="password" class="form-control" name="password"
                                                id="inputPassword" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCPF" class="form-label">CPF</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" class="form-control" name="cpf" id="inputCPF" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputTelefone" class="form-label">Telefone</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" class="form-control" name="phone" id="inputTelefone"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="professionSelect" class="form-label">Profissão</label>
                                        <div class="input-group input-group-outline">
                                            <select id="professionSelect" class="form-select" name="profession"
                                                onchange="toggleOABField()">
                                                <option value="" disabled selected>Selecione a profissão</option>
                                                <?php
                                                $url = 'http://carlo4664.c44.integrator.host:10504/perfis/findAll';
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
                                    <div class="col-md-6" id="oabField" style="display: none;">
                                        <label for="inputOAB" class="form-label">OAB</label>
                                        <div class="input-group input-group-outline">
                                            <input type="text" class="form-control" name="oab" id="inputOAB">
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

    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('myForm').onsubmit = async function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        const response = await fetch(this.action, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        Swal.fire({
            icon: result.status === 'success' ? 'success' : 'error',
            title: result.status === 'success' ? 'Sucesso!' : 'Erro!',
            text: result.message
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = './dashboard.php?r=funcionarios';
            }
        });
    }
</script>
<script>

    function toggleOABField() {
        const select = document.getElementById('professionSelect');
        const oabField = document.getElementById('oabField');
        const oabInput = document.getElementById('inputOAB');

        if (select.value === '1') {
            oabField.style.display = 'block';
            oabInput.setAttribute('required', 'required');
        } else {
            oabField.style.display = 'none';
            oabInput.removeAttribute('required');
            oabInput.value = '';
        }
    }
</script>

<link rel="stylesheet" href="assets/css/custom-styles.css">