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
    $stmt = $conn->prepare("INSERT INTO dbpi1_tbveiculo (dbpi1_tbveiculo_placa, dbpi1_tbveiculo_marcamodeloversao, dbpi1_tbveiculo_anofabricmodelo) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $placa, $marcamodeloversao, $anofabricmodelo);

    // Obtém os dados do formulário
    $placa = $_POST["placa"];
    $marcamodeloversao = $_POST["marcamodeloversao"];
    $anofabricmodelo = $_POST["anofabricmodelo"];

    // Executa a declaração preparada
    if ($stmt->execute()) {
        echo "<br>";
        echo "<p>Registro incluído com sucesso !</p>";
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
            <h2>Manutenção de Veiculos - Inclusão</h2>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="menu_veiculos.php">Retorna 'Menu Veiculos'</a>
            </nav>
        </header>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="cpfcnpj">Placa:</label>
                <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" maxlength="14" placeholder="somente números" required>
            </div>
            <div class="form-group">
                <label for="nomerazao">Marca / Modelo / Versão: </label>
                <input type="text" class="form-control" id="nomerazao" name="nomerazao" maxlength="40" placeholder="Nome ou Razão completo" required>
            </div>
            <div class="form-group">
                <label for="endereco">Ano Fabricação / Modelo:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" maxlength="40" placeholder="Endereço completo" required>
            </div>
            <!--
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" maxlength="11" placeholder="apenas números c/ DDD">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" maxlength="40" placeholder="xxxx@xxxxx.com(.br)">
            </div>
            -->
            <div class="form-group d-flex justify-content-between">
                <input type="submit" class="btn btn-primary mb-2" value="Incluir">
                <input type="button" class="btn btn-secondary mb-2" value="Cancelar" onclick="window.location.href='menu_clientes.php'">
            </div>

        </form>
    </div>

    <!-- BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlO0bTQp+9eLQELHj6V3LBjYd2ZzldC1vM3Q1/cQ3zof2K2f+V4Hj4Kq4EX" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Qj7qf/5bNerAU8+K6d4E4oV2PLWlrW1AVpaOBlBDddWhYUGQ35aeawFslKwPp0" crossorigin="anonymous"></script>
</body>

</html>