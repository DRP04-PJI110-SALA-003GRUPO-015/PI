<!DOCTYPE html>
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
        <header>
		    <h1>PI1 - SUPER TROCA DE ÓLEO</h1>
		    <h2>Manutenção de Ordens de Serviço - Inclusão</h2>	
                <nav>
		        <a href="menu_servicos.php"> Retorna 'Menu Ordens de Serviço'</a>		
            </nav>
	    </header>
        <br>

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
                    echo "Ordem de serviço incluída com sucesso!";
                } else {
                    echo "Erro ao incluir ordem de serviço: " . $conn->error;
                }
            }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="cliente_id">Selecione o Cliente:</label>
            <select id="cliente_id" name="cliente_id">
                <?php
                    if ($result_clientes->num_rows > 0) {
                        while($row_cliente = $result_clientes->fetch_assoc()) {
                            echo "<option value='" . $row_cliente["dbpi1_tbcliente_id"] . "'>" . $row_cliente["dbpi1_tbcliente_nomerazao"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum cliente encontrado</option>";
                    }
                ?>
            </select><br><br>

            <label for="veiculo_id">Selecione o Veículo:</label>
            <select id="veiculo_id" name="veiculo_id">
                <?php
                    if ($result_veiculos->num_rows > 0) {
                        while($row_veiculo = $result_veiculos->fetch_assoc()) {
                            echo "<option value='" . $row_veiculo["dbpi1_tbveiculo_id"] . "'>" . $row_veiculo["dbpi1_tbveiculo_placa"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum veículo encontrado</option>";
                    }
                ?>
            </select><br><br>

            <label for="data_abertura">Data de Abertura:</label>
            <input type="date" id="data_abertura" name="data_abertura" required><br><br>

            <label for="descricao_servico">Descrição do Serviço:</label><br>
            <textarea id="descricao_servico" name="descricao_servico" rows="4" cols="50" required></textarea><br><br>

            <label for="valor_servico_peca">Valor do Serviço/Peça:</label>
            <input type="number" id="valor_servico_peca" name="valor_servico_peca" step="0.01" required><br><br>
    
            <label for="kilometragem">Kilometragem atual:</label>
            <input type="number" id="kilometragem" name="kilometragem" step="0.01" required><br><br>

            <input type="hidden" name="status_ordem" value="Aberta">

            <input type="submit" value="Incluir Ordem de Serviço">
            <input type="button" value="Cancelar" onclick="window.location.href='menu_servicos.php'">
        </form>
    </body>
</html>
