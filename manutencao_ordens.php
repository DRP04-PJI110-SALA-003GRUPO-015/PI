<!DOCTYPE html>
<html>
    <head>
    	<title>PI1 - SUPER TROCA DE ÓLEO</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width-device-width,initial-scale=1.0">
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    	<!-- FONT AWESOME -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <!-- CSS -->
		<link rel="stylesheet" type="text/css" href="geral.css">
	</head>

    <body>
        <header>
	    	<h1>PI1 - SUPER TROCA DE ÓLEO</h1>
            <h2>Ordens de serviço - Consulta / Alteração / Fechamento / Cancelamento</h2>
            <nav>
	            <a href="menu_servicos.php"> Retorna 'Menu Ordens de serviço'</a>		
            </nav>
        </header>
        <br>

        <div class="container">
            <h1 style="text-align: center;">Ordens de serviço</h1>
            <br>
            <table>
                <tbody>
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
                            echo "<table>";
                            echo "<tr><th>ID da Ordem</th><th>Placa do Veículo</th><th>Marca/Modelo/Versão</th><th>Nome/Razão do Cliente</th><th>Km</th><th>Serviços</th><th>(R$) Peças / Serviços</th><th>Data abertura</th><th>Status</th><th>Data fechamento</th><th>Data cancelamento</th><th>Ações</th></tr>";
                            // Output data de cada linha
                            while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row["dbpi1_tbordem_id"]."</td>";
                            echo "<td>".$row["dbpi1_tbveiculo_placa"]."</td>";
                            echo "<td>".$row["dbpi1_tbveiculo_marcamodeloversao"]."</td>";
                            echo "<td>".$row["dbpi1_tbcliente_nomerazao"]."</td>";
                            echo "<td>".$row["dbpi1_tbordem_kilometragem"]."</td>";
                            echo "<td>".$row["dbpi1_tbordem_descricaoservico"]."</td>";
                            echo "<td>".$row["dbpi1_tbordem_valorservicopeca"]."</td>";
                            echo "<td>".$row["dbpi1_tbordem_dataabertura"]."</td>";
                            echo "<td>".$row["dbpi1_tbordem_status"]."</td>";                            
                            echo "<td>".$row["dbpi1_tbordem_datafechamento"]."</td>";                            
                            echo "<td>".$row["dbpi1_tbordem_datacancelamento"]."</td>";
                            echo "<td class='button-container'>";
                            echo "<button onclick='editarRegistro(".$row["dbpi1_tbordem_id"].")'>Atualizar</button>";
                            echo "<button onclick='fecharRegistro(".$row["dbpi1_tbordem_id"].")'>Fechar</button>";
                            echo "<button onclick='cancRegistro(".$row["dbpi1_tbordem_id"].")'>Cancelar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                            echo "</table>";
                        } else {
                            echo "0 resultados encontrados.";
                        }

                        // Fecha a conexão com o banco de dados
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            // Função JavaScript para editar um registro
            function editarRegistro(id) {
                // Redireciona para a página de edição com o ID do registro
                window.location.href = "editar_registro_ordem.php?id=" + id;
            }
            // Função JavaScript para excluir um registro
            function fecharRegistro(id) {
                if (confirm("Tem certeza que deseja FECHAR esta ordem de serviço ?")) {
                // Envia uma requisição para excluir o registro e recarregar a página
                window.location.href = "fechar_registro_ordem.php?id=" + id;
                }
            }
            // Função JavaScript para excluir um registro
            function cancRegistro(id) {
                if (confirm("Tem certeza que deseja CANCELAR esta ordem de serviço ?")) {
                // Envia uma requisição para excluir o registro e recarregar a página
                window.location.href = "cancelar_registro_ordem.php?id=" + id;
                }
            }
        </script>
    </body>
</html>
