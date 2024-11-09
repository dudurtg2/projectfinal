<div class="container-fluid py-2">
    <div class="calendar-color">
        <div class="card-2">
            <div class="card-body calendar-color">
                <div class="flex-grow-1 me-3 d-flex align-items-center">
                    <span class="me-2">
                        <i class="fas fa-search"></i>
                    </span>
                    <form id="searchForm" action="dashboard.php?r=tarefas" method="POST" class="d-flex w-100">
                        <div class="input-group input-group-outline w-100">
                            <label class="form-label">Pesquise por clientes ou código...</label>
                            <input type="text" class="form-control" name="busca" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> aa </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("includes/_responce/processos.php");
?>

<?php include("includes/calendar.php"); ?>