<!DOCTYPE html>
<html lang="pt-br">



<?php 
include("includes/head.php");
 ?>

<body class="g-sidenav-show  bg-gray-100">

  <?php include("includes/sidenav.php"); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->

    <?php include("includes/card.php"); ?>

    <?php if (isset($_GET["r"])) {
      switch ($_GET["r"]) {
        case "clientes":
          include("pages/clientes.php");
          break;
        case "funcionarios":
          include("pages/funcionarios.php");
          break;
        case "processos":
          include("pages/processos.php");
          break;
        case "tarefas":
          include("pages/tarefas.php");
          break;
        case "resgistrar":
          include("pages/resgistrar.php");
          break;
        case "acompanhamento":
          include("pages/acompanhamento.php");
          break;
        case "perfil":
          include("pages/perfil.php");
          break;
        
        default:
          include("includes/calendar.php");
          break;

      }
    } else {
      include("includes/principal.php");
    }
    ?>
    <?php include("includes/footer.php"); ?>

  </main>
  <?php include("includes/scripts.php"); ?>
  

</body>

</html>