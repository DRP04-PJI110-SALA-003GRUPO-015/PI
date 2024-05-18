<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $servername = "localhost"; // Seu servidor MySQL
    $username = "root"; // Seu nome de usuário MySQL
    $password = ""; // Sua senha MySQL
    $dbname = "dbpi1"; // Nome do banco de dados

    // Cria conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Prepara as declarações SQL para prevenir injeção de SQL
    $stmt = $conn->prepare("INSERT INTO dbpi1_tbusuario (dbpi1_tbusuario_nome, dbpi1_tbusuario_cargo, dbpi1_tbusuario_departamento, dbpi1_tbusuario_senha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nome, $cargo, $departamento, $senha);

    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $cargo = $_POST["cargo"];
    $departamento = $_POST["departamento"];
    $senha = $_POST["senha"];

    // Executa a declaração preparada
    if ($stmt->execute()) {
        // echo "<div>";
        echo "<br>";
        echo "<h2>Registro incluído com sucesso!</h2>";
        // echo "</div>";
    } else {
        echo "Erro ao incluir registro: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>


<!doctype html>
<html>
<head>
    <title>PI1 - SUPER TROCA DE ÓLEO</title>
    <meta charset="utf-8">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- LINK ANTERIOR DE FONTES AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="geral.css">
</head>

<body>
    <div class="container mt-4">
        <header class="mb-4">
            <h1>PI1 - SUPER TROCA DE ÓLEO</h1>
            <h2>Manutenção de Usuários - Inclusão</h2>
            <nav>
                <a href="menu_usuarios.php"> Retorna 'Menu de Usuários'</a>
            </nav>
        </header>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" maxlength="40" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" maxlength="20" required>
            </div>
            <div class="form-group">
                <label for="departamento">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" maxlength="20" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" maxlength="6" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <input type="submit" class="btn btn-primary" value="Incluir">
                <input type="button" class="btn btn-secondary" value="Cancelar" onclick="window.location.href='menu_usuarios.php'">
            </div>
        </form>
    </div>

    <!-- BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlO0bTQp+9eLQELHj6V3LBjYd2ZzldC1vM3Q1/cQ3zof2K2f+V4Hj4Kq4EX" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Qj7qf/5bNerAU8+K6d4E4oV2PLWlrW1AVpaOBlBDddWhYUGQ35aeawFslKwPp0" crossorigin="anonymous"></script>
</body>
</html>


<?php
