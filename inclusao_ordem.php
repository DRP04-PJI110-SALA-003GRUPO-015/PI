<!DOCTYPE html>
<html>
<head>
    <title>PI1 - SUPER TROCA DE ÓLEO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <header class="container mt-4">
        <div class="container">
            <h1 class="text-center">PI1 - SUPER TROCA DE ÓLEO</h1>
            <h2 class="text-center">Manutenção de Ordens de Serviço - Inclusão</h2>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="menu_servicos.php">Retorna 'Menu Ordens de Serviço'</a>
            </nav>
        </div>
    </header>
    <br>
    <div class="container">
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Consulta para obter os clientes
        $sql_clientes = "SELECT dbpi1_tbcliente_id, dbpi1_tbcliente_nomerazao FROM dbpi1_tbcliente ORDER BY dbpi1_tbcliente_nomerazao";
        $result_clientes = $conn->query($sql_clientes);

        // Consulta para obter os veículos
        $sql_veiculos = "SELECT dbpi1_tbveiculo_id, dbpi1_tbveiculo_placa FROM dbpi1_tbveiculo ORDER BY dbpi1_tbveiculo_placa";
        $result_veiculos = $conn->query($sql_veiculos);

        // Verifica se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cliente_id = $_POST['cliente_id'];
            $veiculo_id = $_POST['veiculo_id'];
            $data_abertura = $_POST['data_abertura'];
            $descricao_servico = $_POST['descricao_servico'];
            $valor_servico_peca = $_POST['valor_servico_peca'];
            $kilometragem = $_POST['kilometragem'];
            $status_ordem = $_POST['status_ordem'];

            // Insere a ordem de serviço no banco de dados
            $sql_ordem = "INSERT INTO dbpi1_tbordem (dbpi1_tbordem_clienteid, dbpi1_tbordem_veiculoid, dbpi1_tbordem_dataabertura, dbpi1_tbordem_descricaoservico, dbpi1_tbordem_valorservicopeca, dbpi1_tbordem_kilometragem, dbpi1_tbordem_status) VALUES ($cliente_id, $veiculo_id, '$data_abertura', '$descricao_servico', $valor_servico_peca, $kilometragem, '$status_ordem')";
            if ($conn->query($sql_ordem) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Ordem de serviço incluída com sucesso!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Erro ao incluir ordem de serviço: ' . $conn->error . '</div>';
            }
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="cliente_id">Selecione o Cliente:</label>
                <select class="form-control" id="cliente_id" name="cliente_id" required>
                    <?php
                    if ($result_clientes->num_rows > 0) {
                        while($row_cliente = $result_clientes->fetch_assoc()) {
                            echo "<option value='" . $row_cliente["dbpi1_tbcliente_id"] . "'>" . $row_cliente["dbpi1_tbcliente_nomerazao"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum cliente encontrado</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="veiculo_id">Selecione o Veículo:</label>
                <select class="form-control" id="veiculo_id" name="veiculo_id" required>
                    <?php
                    if ($result_veiculos->num_rows > 0) {
                        while($row_veiculo = $result_veiculos->fetch_assoc()) {
                            echo "<option value='" . $row_veiculo["dbpi1_tbveiculo_id"] . "'>" . $row_veiculo["dbpi1_tbveiculo_placa"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum veículo encontrado</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="data_abertura">Data de Abertura:</label>
                <input type="date" class="form-control" id="data_abertura" name="data_abertura" required>
            </div>

            <div class="form-group">
                <label for="descricao_servico">Descrição do Serviço:</label>
                <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="valor_servico_peca">Valor do Serviço/Peça:</label>
                <input type="number" class="form-control" id="valor_servico_peca" name="valor_servico_peca" step="0.01" required>
            </div>
    
            <div class="form-group">
                <label for="kilometragem">Kilometragem atual:</label>
                <input type="number" class="form-control" id="kilometragem" name="kilometragem" step="0.01" required>
            </div>

            <input type="hidden" name="status_ordem" value="Aberta">

            <button type="submit" class="btn btn-primary">Incluir Ordem de Serviço</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='menu_servicos.php'">Cancelar</button>
        </form>
    </div>

    <!-- BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlO0bTQp+9eLQELHj6V3LBjYd2ZzldC1vM3Q1/cQ3zof2K2f+V4Hj4Kq4EX" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Qj7qf/5bNerAU8+K6d4E4oV2PLWlrW1AVpaOBlBDddWhYUGQ35aeawFslKwPp0" crossorigin="anonymous"></script>
</body>
</html>
