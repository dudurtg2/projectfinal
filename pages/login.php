<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start(); 
include("../includes/head.php");
?>
<body class="g-sidenav-show bg-gray-100">
  <main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100"
      style="background-image: url('../assets/images/bg.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto tela-login">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card-login z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="color-primary shadow-dark border-radius-lg py-3 pe-1">
                  <h5 class="text-white text-center mt-2 mb-0">Bem-vindo ao Advocatos</h5>
                </div>
              </div>
              <div class="card-body">
               
                <?php
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']); 
                }
                ?>
                
                <form role="form" class="text-start" action="../includes/_scripts/repository/auth.php" method="POST">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Logar</button>
                  </div>
                
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
