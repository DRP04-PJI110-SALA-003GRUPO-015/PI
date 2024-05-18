<!DOCTYPE html>
<html>

<head>
    <title>PI1 - SUPER TROCA DE ÓLEO</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="geral.css">
</head>

<body>
    <div class="container mt-4">
        <header class="mb-4 text-center">
            <h1>PI1 - SUPER TROCA DE ÓLEO</h1>
            <h2>Manutenção de Usuários - Consulta / Alteração / Exclusão</h2>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="menu_usuarios.php">Retorna 'Menu de Usuários'</a>
            </nav>
        </header>

        <h1 class="text-center">Usuários</h1>
        <br>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Departamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "dbpi1";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Consulta SQL para obter todos os registros
                        $sql = "SELECT * FROM dbpi1_tbusuario";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        // Exibe os registros em uma tabela
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['dbpi1_tbusuario_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dbpi1_tbusuario_nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dbpi1_tbusuario_cargo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['dbpi1_tbusuario_departamento']) . "</td>";
                            echo "<td><button class='btn btn-primary btn-sm' onclick='editarRegistro(" . htmlspecialchars($row['dbpi1_tbusuario_id']) . ")'>Atualizar</button> ";
                            echo "<button class='btn btn-danger btn-sm' onclick='excluirRegistro(" . htmlspecialchars($row['dbpi1_tbusuario_id']) . ")'>Excluir</button></td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='5'>Erro: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Função JavaScript para editar um registro
        function editarRegistro(id) {
            // Redireciona para a página de edição com o ID do registro
            window.location.href = "editar_registro_usuario.php?id=" + id;
        }

        // Função JavaScript para excluir um registro
        function excluirRegistro(id) {
            if (confirm("Tem certeza que deseja excluir este registro?")) {
                // Envia uma requisição para excluir o registro e recarregar a página
                window.location.href = "excluir_registro_usuario.php?id=" + id;
            }
        }
    </script>

    <!-- BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlO0bTQp+9eLQELHj6V3LBjYd2ZzldC1vM3Q1/cQ3zof2K2f+V4Hj4Kq4EX" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Qj7qf/5bNerAU8+K6d4E4oV2PLWlrW1AVpaOBlBDddWhYUGQ35aeawFslKwPp0" crossorigin="anonymous"></script>
</body>

</html>

