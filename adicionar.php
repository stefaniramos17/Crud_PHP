<?php require 'config.php';
//Adicionar
// $nome = trim($_POST['nome'] ?? '');
// $email = trim($_POST['email'] ?? '');

// if(!empty($nome) && !empty($email)){


//     $sql = $db->prepare("INSERT INTO contatos (nome, email) VALUES (:nome, :email)");
//     $sql->bindValue(':nome', $nome);
//     $sql->bindValue(':email', $email);
//     $sql->execute();
//     header("Location: index.php");
//     exit;
// } 

$nome = trim($_POST['nome'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');
$horario_entrada = trim($_POST['horario_entrada'] ?? '');

$error = '';

if (!empty($nome) && !empty($cargo) && !empty($horario_entrada)) {

    //if (filter_var($cargo, FILTER_VALIDATE_EMAIL)) {

        $check = $db->prepare("SELECT id FROM funcionario WHERE nome = :nome");
        $check->bindValue(':nome', $nome);
        $check->execute();

        if ($check->rowCount() == 0) {
            $sql = $db->prepare("INSERT INTO funcionario (nome, cargo, horario_entrada) VALUES (:nome, :cargo, :horario_entrada)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':cargo', $cargo);
            $sql->bindValue(':horario_entrada', $horario_entrada);
            $sql->execute();
            header("Location: index.php");
            exit;
        } else {
            $error = 'Funcionario já está cadastrado!';
        }
    }



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
    

        <?php if ($error): ?>
            <div class="alert alert-warning"><?= $error ?></div>
        <?php endif; ?>

        <h3>Adicionar</h3>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cargo:</label>
                <input type="text" class="form-control" name="cargo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Horário de Entrada:</label>
                <input type="text" class="form-control" name="horario_entrada" required>
            </div>

            <button type="submit" class="btn btn-outline-success">Adicionar</button>
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