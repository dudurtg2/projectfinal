<?php if ($processosEncontrados !== null): ?>
  <h3>Resultados encontrados:</h3>
  <?php if (!empty($processosEncontrados)): ?>
    <div class="list-group">
      <?php
      if (isset($processosEncontrados['codigo'])) {
        echo "<a href='dashboard.php?r=acompanhamento&codigo=" . urlencode($processosEncontrados['codigo']) . "' class='list-group-item list-group-item-action'>";
        echo "<div class='process-box'>";
        echo "<h5>Código: " . htmlspecialchars($processosEncontrados['codigo']) . "</h5>";
        echo "<h5>Data: " . htmlspecialchars($processosEncontrados['data']) . "</h5>";
        echo "<p><strong>Cliente:</strong> " . htmlspecialchars($processosEncontrados['clientes']['nome']) . "</p>";
        echo "<p><strong>Funcionario:</strong> " . htmlspecialchars($processosEncontrados['funcionarios']['nome']) . "</p>";
        echo "<p><strong>Status:</strong> " . htmlspecialchars($processosEncontrados['documentoProcessos']['status']) . "</p>";
        echo "<p><strong>Descrição:</strong> " . htmlspecialchars($processosEncontrados['documentoProcessos']['descrisao']) . "</p>";
        echo "</div>";
        echo "</a>";
      } else {
        foreach ($processosEncontrados as $processo) {
          echo "<a href='dashboard.php?r=acompanhamento&codigo=" . urlencode($processo['codigo']) . "' class='list-group-item list-group-item-action'>";
          echo "<div class='process-box'>";
          echo "<h5>Código: " . htmlspecialchars($processo['codigo']) . "</h5>";
          echo "<h5>Data: " . htmlspecialchars($processo['data']) . "</h5>";
          echo "<p><strong>Cliente:</strong> " . htmlspecialchars($processo['clientes']['nome']) . "</p>";
          echo "<p><strong>Funcionario:</strong> " . htmlspecialchars($processo['funcionarios']['nome']) . "</p>";
          echo "<p><strong>Status:</strong> " . htmlspecialchars($processo['documentoProcessos']['status']) . "</p>";
          echo "<p><strong>Descrição:</strong> " . htmlspecialchars($processo['documentoProcessos']['descrisao']) . "</p>";
          echo "</div>";
          echo "</a>";
        }
      }
      ?>
    </div>
  <?php else: ?>
    <p>Nenhum processo encontrado.</p>
  <?php endif; ?>
<?php endif; ?>