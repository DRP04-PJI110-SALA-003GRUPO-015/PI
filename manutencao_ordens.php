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
    <header class="container mt-4">
        <div class="container">
            <h1 class="text-center">PI1 - SUPER TROCA DE ÓLEO</h1>
            <h2 class="text-center">Ordens de serviço - Consulta / Alteração / Fechamento / Cancelamento</h2>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="menu_servicos.php">Retorna 'Menu Ordens de serviço'</a>
            </nav>
        </div>
    </header>
    <br>

    <div class="container">
        <h1 class="text-center">Ordens de serviço</h1>
        <br>
        <div class="row">
            <?php
                // Conexão com o banco de dados
                $servername = "localhost"; // Altere conforme necessário
                $username = "root"; // Altere conforme necessário
                $password = ""; // Altere conforme necessário
                $dbname = "dbpi1"; // Nome do banco de dados
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica se a conexão foi bem-sucedida
                if ($conn->connect_error) {
                    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                }

                // Consulta SQL para selecionar os registros da tabela "dbpi1_tbordem" com informações relacionadas de outras tabelas
                $sql = "SELECT o.dbpi1_tbordem_id, v.dbpi1_tbveiculo_placa, v.dbpi1_tbveiculo_marcamodeloversao, c.dbpi1_tbcliente_nomerazao, o.dbpi1_tbordem_dataabertura, o.dbpi1_tbordem_kilometragem, o.dbpi1_tbordem_status, o.dbpi1_tbordem_valorservicopeca, o.dbpi1_tbordem_descricaoservico, o.dbpi1_tbordem_datafechamento, o.dbpi1_tbordem_datacancelamento
                FROM dbpi1_tbordem o
                INNER JOIN dbpi1_tbcliente c ON o.dbpi1_tbordem_clienteid = c.dbpi1_tbcliente_id
                INNER JOIN dbpi1_tbveiculo v ON o.dbpi1_tbordem_veiculoid = v.dbpi1_tbveiculo_id
                WHERE dbpi1_tbordem_status='Aberta'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4 mb-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Ordem ID: ".$row["dbpi1_tbordem_id"]."</h5>";
                        echo "<p class='card-text'><strong>Placa:</strong> ".$row["dbpi1_tbveiculo_placa"]."</p>";
                        echo "<p class='card-text'><strong>Marca/Modelo/Versão:</strong> ".$row["dbpi1_tbveiculo_marcamodeloversao"]."</p>";
                        echo "<p class='card-text'><strong>Cliente:</strong> ".$row["dbpi1_tbcliente_nomerazao"]."</p>";
                        echo "<p class='card-text'><strong>Km:</strong> ".$row["dbpi1_tbordem_kilometragem"]."</p>";
                        echo "<p class='card-text'><strong>Serviços:</strong> ".$row["dbpi1_tbordem_descricaoservico"]."</p>";
                        echo "<p class='card-text'><strong>Valor Peças/Serviços:</strong> ".$row["dbpi1_tbordem_valorservicopeca"]."</p>";
                        echo "<p class='card-text'><strong>Data Abertura:</strong> ".$row["dbpi1_tbordem_dataabertura"]."</p>";
                        echo "<p class='card-text'><strong>Status:</strong> ".$row["dbpi1_tbordem_status"]."</p>";
                        echo "<p class='card-text'><strong>Data Fechamento:</strong> ".$row["dbpi1_tbordem_datafechamento"]."</p>";
                        echo "<p class='card-text'><strong>Data Cancelamento:</strong> ".$row["dbpi1_tbordem_datacancelamento"]."</p>";
                        echo "<div class='text-center'>";
                        echo "<button class='btn btn-warning btn-sm mb-1' onclick='editarRegistro(".$row["dbpi1_tbordem_id"].")'>Atualizar</button>";
                        echo "<button class='btn btn-success btn-sm mb-1' onclick='fecharRegistro(".$row["dbpi1_tbordem_id"].")'>Fechar</button>";
                        echo "<button class='btn btn-danger btn-sm mb-1' onclick='cancRegistro(".$row["dbpi1_tbordem_id"].")'>Cancelar</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='col-12'><p class='text-center'>0 resultados encontrados.</p></div>";
                }

                // Fecha a conexão com o banco de dados
                $conn->close();
            ?>
        </div>
    </div>

    <!-- BOOTSTRAP JS, POPPER.JS, AND JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlO0bTQp+9eLQELHj6V3LBjYd2ZzldC1vM3Q1/cQ3zof2K2f+V4Hj4Kq4EX" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Qj7qf/5bNerAU8+K6d4E4oV2PLWlrW1AVpaOBlBDddWhYUGQ35aeawFslKwPp0" crossorigin="anonymous"></script>
    
    <script>
        // Função JavaScript para editar um registro
        function editarRegistro(id) {
            // Redireciona para a página de edição com o ID do registro
            window.location.href = "editar_registro_ordem.php?id=" + id;
        }
        // Função JavaScript para fechar um registro
        function fecharRegistro(id) {
            if (confirm("Tem certeza que deseja FECHAR esta ordem de serviço?")) {
                // Envia uma requisição para fechar o registro e recarregar a página
                window.location.href = "fechar_registro_ordem.php?id=" + id;
            }
        }
        // Função JavaScript para cancelar um registro
        function cancRegistro(id) {
            if (confirm("Tem certeza que deseja CANCELAR esta ordem de serviço?")) {
                // Envia uma requisição para cancelar o registro e recarregar a página
                window.location.href = "cancelar_registro_ordem.php?id=" + id;
            }
        }
    </script>
</body>
</html>
