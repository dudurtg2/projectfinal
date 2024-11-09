<?php
function buscarProcesso($busca)
{

  $urlCodigo = 'http://carlo4664.c44.integrator.host:10504/processos/findByCodigo/' . urlencode($busca);
  $ch = curl_init($urlCodigo);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);


  if ($httpCode == 200 && !empty($response)) {
    return json_decode($response, true);
  }


  $urlCliente = 'http://carlo4664.c44.integrator.host:10504/processos/findByClientesNomeLike/' . urlencode($busca);
  $ch = curl_init($urlCliente);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  return json_decode($response, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['busca'])) {
  $busca = $_POST['busca'];

  if (!empty($busca)) {
    $resultado = buscarProcesso($busca);

    if (!empty($resultado)) {
      $processosEncontrados = $resultado;
    } else {
      $processosEncontrados = null;
    }
  } else {
    $processosEncontrados = null;
  }
} else {
  $processosEncontrados = null;
}

$url = 'http://carlo4664.c44.integrator.host:10504/processos/findAll';
$response = file_get_contents($url);

$aberto = 0;
$perdido = 0;
$vencido = 0;

$processos = [];
if ($response !== FALSE) {
  $processos = json_decode($response, true);
}
if (is_array($processos)) {
  foreach ($processos as $processo) {
    if ($processo['documentoProcessos']['status'] == 'aberto') {
      $aberto++;
    } elseif ($processo['documentoProcessos']['status'] == 'Perdido') {
      $perdido++;
    } elseif ($processo['documentoProcessos']['status'] == 'Concluído') {
      $vencido++;
    }
  }
}

$total = $aberto + $perdido + $vencido;
?>