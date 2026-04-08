<?php require 'config.php'; 

    $lista = $db->query("SELECT * FROM funcionario")->fetchAll();

    if(!empty($_GET['del'])){
        $id = $_GET['del'];
        $sql = $db->prepare("DELETE FROM funcionario WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        header("Location: index.php?msg=del_ok");
        exit;
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
            <span class="navbar-brand mb-0 h1 mx-auto">Assiduidade</span>
        </div>
    </nav>

    <div class="container">

     <?php 

            if(isset($_GET['msg']) && $_GET['msg'] == 'add_ok'):
         ?>

        <div id="alert-msg" class="alert alert-succes mt-4">Adicionado com sucesso!</div>

        <?php endif; ?>

        <?php 

            if(isset($_GET['msg']) && $_GET['msg'] == 'del_ok'):
         ?>

        <div id="alert-msg" class="alert alert-danger mt-4">Funcionário Removido</div>

        <?php endif; ?>

        <a href="adicionar.php" class="btn btn-outline-success mt-3">Adicionar funcionário</a>


        <!-- Listagem início -->

        <table class="table text-center table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Horário de Entrada</th>
                </tr>
            </thead>
            <tbody class="table-group-divider aling-middle">

            <?php foreach($lista as $item): ?>

                <tr>
                    <th scope="row"><?php echo $item['id']; ?></th>
                    <td><?= $item['nome']; ?></td>
                    <td><?= $item['cargo']; ?></td>
                    <td><?= $item['horario_entrada']; ?></td>
                    <td>
                        <a href="editar.php?id=<?= $item['id']; ?>" class="btn btn-outline-success">Editar</a>
                        <a href="index.php?del=<?= $item['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Excluir?')">Excluir</a>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
 
        <!-- Listagem final -->
    </div>

    <footer>
        <nav class="navbar">
            <div class="container-fluid">
                <span class="navbar mx-auto">&copy; Todos os direitos reservados</span>
            </div>
        </nav>
    </footer>

    <script>
        const alertMsg = document.getElementById('alert-msg');

        if(alertMsg){
            setTimeout(() =>{
                alertMsg.style.display = 'none';
            }, 3000);
        }
    </script>

    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>