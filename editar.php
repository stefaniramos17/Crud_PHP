<?php require 'config.php';

    $id = $_GET['id'] ?? '';

    if(empty($id)){
        header("Location: index.php");
        exit;
    }

    if(!empty($_POST['nome']) && !empty($_POST['email'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = $db->prepare("UPDATE contatos SET nome = :nome, email = :email WHERE id = :id");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':id', $id);
        $sql->execute();
        header("Location: index.php");
        exit;

    }

    $sql = $db->prepare("SELECT * FROM contatos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    $info = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Contatos</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar bg-dark navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">SISTEMA DE CONTATO</span>
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
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= $info['email'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
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