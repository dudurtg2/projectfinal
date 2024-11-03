<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagens</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Upload de Imagens</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="linkRg">RG:</label>
                <input type="file" class="form-control-file" id="linkRg" name="linkRg" required>
            </div>
            <div class="form-group">
                <label for="linkResidencia">Comprovante de Residência:</label>
                <input type="file" class="form-control-file" id="linkResidencia" name="linkResidencia" required>
            </div>
            <div class="form-group">
                <label for="linkEstadoCivil">Estado Civil:</label>
                <input type="file" class="form-control-file" id="linkEstadoCivil" name="linkEstadoCivil" required>
            </div>
            <div class="form-group">
                <label for="linkProvas">Provas (múltiplas):</label>
                <input type="file" class="form-control-file" id="linkProvas" name="linkProvas[]" multiple required>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>
</html>
