<?php
    // Verifica se o ID do registro a ser editado foi recebido
    if(isset($_GET["id"])) {
        // Obtém o ID do registro
        $id = $_GET["id"];

        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        // Consulta SQL para obter os dados da ordem de serviço
        $sql_ordem = "SELECT * FROM dbpi1_tbordem WHERE dbpi1_tbordem_id = $id";
        $result_ordem = $conn->query($sql_ordem);
        // Verifica se há resultados
        if ($result_ordem->num_rows > 0) {
           // Obtem o registro
           $row = $result_ordem->fetch_assoc();
           $var_ordemid = $row["dbpi1_tbordem_id"];
           $var_clienteid = $row['dbpi1_tbordem_clienteid'];
           $var_veiculoid = $row['dbpi1_tbordem_veiculoid'];
           $var_dataabertura = $row['dbpi1_tbordem_dataabertura'];
           $var_descricaoservico = $row['dbpi1_tbordem_descricaoservico'];
           $var_valorservicopeca = $row['dbpi1_tbordem_valorservicopeca'];
           $var_kilometragem = $row['dbpi1_tbordem_kilometragem'];
                       
        } else {
           echo "Nenhum resultado encontrado.";
        }     

        // Consulta SQL para obter o nome do cliente da ordem
        $sqlclientenome = "SELECT * FROM dbpi1_tbcliente WHERE dbpi1_tbcliente_id = $var_clienteid";
        $resultclientenome = $conn->query($sqlclientenome);
        // Verifica se há resultados
        if ($resultclientenome->num_rows > 0) {
            // Obtem o registro
            $row = $resultclientenome->fetch_assoc();
            $var_nome_cliente_ordem = $row["dbpi1_tbcliente_nomerazao"];
        } else {
            echo "Nenhum resultado encontrado.";
        }                

        // Consulta SQL para obter a placa do veículo
        $sqlplacaveiculo = "SELECT * FROM dbpi1_tbveiculo WHERE dbpi1_tbveiculo_id = $var_veiculoid";
        $resultplacaveiculo = $conn->query($sqlplacaveiculo);
        // Verifica se há resultados
        if ($resultplacaveiculo->num_rows > 0) {
            // Obtem o registro
            $row = $resultplacaveiculo->fetch_assoc();
            $var_placa_veiculo_ordem = $row["dbpi1_tbveiculo_placa"];
        } else {
            echo "Nenhum resultado encontrado.";
        }                

        // Consulta para obter os clientes
        $sql_clientes = "SELECT dbpi1_tbcliente_id, dbpi1_tbcliente_nomerazao FROM dbpi1_tbcliente ORDER BY dbpi1_tbcliente_nomerazao";
        $result_clientes = $conn->query($sql_clientes);

        // Consulta para obter os veículos
        $sql_veiculos = "SELECT dbpi1_tbveiculo_id, dbpi1_tbveiculo_placa FROM dbpi1_tbveiculo ORDER BY dbpi1_tbveiculo_placa";
        $result_veiculos = $conn->query($sql_veiculos);
        
    }
?>

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
    <header>
			<h1>PI1 - SUPER TROCA DE ÓLEO</h1>
			<h2>Manutenção de Ordens de Serviço - Alteração</h2>	
            <nav>
			    <a href="manutencao_ordens.php"> Retorna 'Manutenção de Ordens de Serviço'</a>		
            </nav>
	</header>
    <br>

    <body>

        <form action="processar_atualizacao_ordem.php" method="post">        
        <input type="hidden" name="id" value="<?php echo $var_ordemid; ?>">
        <h5>Ordem de Serviço ID: "<?php echo $var_ordemid; ?>" </h5>
        <BR>
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
            </select>
            <b> - Cliente atual: </b> "<?php echo $var_nome_cliente_ordem; ?>" <br><br>

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
            </select>
            <b> - Veículo atual: </b> "<?php echo $var_placa_veiculo_ordem; ?>" <br><br>

            <!-- CORRESPONDÊNCIAS
            $var_ordemid = $row["dbpi1_tbordem_id"];
            $var_clienteid = $row['dbpi1_tbordem_clienteid'];
            $var_veiculoid = $row['dbpi1_tbordem_veiculoid'];
            $var_dataabertura = $row['dbpi1_tbordem_dataabertura'];
            $var_descricaoservico = $row['dbpi1_tbordem_descricaoservico'];
            $var_valorservicopeca = $row['dbpi1_tbordem_valorservicopeca'];
            $var_kilometragem = $row['dbpi1_tbordem_kilometragem'];
            $var_nome_cliente_ordem = $row["dbpi1_tbordem_nomerazao"];
            $var_placa_veiculo_ordem = $row["dbpi1_tbveiculo_placa"];
            -->
            
            <label for="dataabertura">Data de Abertura:</label> 
            <input type="date" id="dataabertura" name="dataabertura" required> <b> - Data atual: </b>"<?php echo $var_dataabertura; ?>" <br><br>
         
            <label for="descricaoservico">Descrição do Serviço:</label><br>
            <textarea id="descricaoservico" name="descricaoservico" rows="2" cols="50" required></textarea> <b> - Descrição atual: </b> "<?php echo $var_descricaoservico; ?>" <br><br>
            
            <label for="valorservicopeca">Valor do Serviço/Peça:</label>
            <input type="number" id="valorservicopeca" name="valorservicopeca" step="0.01" required> <b> - Valor atual: </b> "<?php echo $var_valorservicopeca; ?>" <br><br>
                
            <label for="kilometragem">Kilometragem atual:</label>
            <input type="number" id="kilometragem" name="kilometragem" step="0.01" required> <b> - Kilometragem atual: </b> "<?php echo $var_kilometragem; ?>" <br><br>
                        
            <input type="submit" value="Atualizar ordem de serviço">
            <input type="button" value="Cancelar" onclick="window.location.href='manutencao_ordens.php'">

                        
        </form>

    </body>
</html>
