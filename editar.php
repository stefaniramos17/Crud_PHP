<?php require 'config.php';

    $id = $_GET['id'] ?? '';

    if(empty($id)){
        header("Location: index.php");
        exit;
    }

    if(!empty($_POST['nome']) && !empty($_POST['cargo'])){
        $nome = $_POST['nome'];
        $cargo = $_POST['cargo'];
        $horario_entrada = $_POST['horario_entrada'];

        $sql = $db->prepare("UPDATE funcionario SET nome = :nome, cargo = :cargo, horario_entrada = :horario_entrada WHERE id = :id");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':cargo', $cargo);
        $sql->bindValue(':horario_entrada', $horario_entrada);
        $sql->bindValue(':id', $id);
        $sql->execute();
        header("Location: index.php");
        exit;

    }

    $sql = $db->prepare("SELECT * FROM funcionario WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    $info = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assiduidade</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar" style="background-color: #004e18;" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">ASSIDUIDADE</span>
        </div>
    </nav>

    <div class="container mt-3">

        <h3>Editar</h3>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" value="<?= $info['nome'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cargo:</label>
                <input type="text" class="form-control" name="cargo" value="<?= $info['cargo'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Horário de Entrada:</label>
                <input type="text" class="form-control" name="horario_entrada" value="<?= $info['horario_entrada'] ?>" required>
            </div>

            <button type="submit" class="btn btn-outline-success">Editar</button>
            <a href="index.php" class="btn btn-outline-secondary">Voltar</a>
        </form>

    </div>

    <footer>
        <nav class="navbar">
            <div class="container-fluid">
                <span class="navbar mx-auto">&copy; Todos os direitos reservados</span>
            </div>
        </nav>
    </footer>


    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>