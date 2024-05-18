<!DOCTYPE html>
<html>
<head>
    	<title>PI1 - SUPER TROCA DE ÓLEO</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width-device-width,initial-scale=1.0">
		<title>Projeto Integrador 1</title>
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    	<!-- FONT AWESOME -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <!-- CSS -->
		<link rel="stylesheet" type="text/css" href="geral.css">
	</head>
    
</head>

<body>
    <header>
		<h1>PI1 - SUPER TROCA DE ÓLEO</h1>
        <h2>Manutenção de Veiculos - Consulta / Alteração</h2>
        <nav>
	        <a href="menu_veiculos.php"> Retorna 'Menu Veiculos'</a>		
        </nav>
    </header>
    <br>

<div class="container">
    <h1 style="text-align: center;">Veiculos</h1>
    <br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca / Modelo / Versão</th>
                <th>Ano fabricação/modelo</th>
                <th>Opções</th>
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
                $sql = "SELECT * FROM dbpi1_tbveiculo";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                // Exibe os registros em uma tabela
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['dbpi1_tbveiculo_id'] . "</td>";
                    echo "<td>" . $row['dbpi1_tbveiculo_placa'] . "</td>";
                    echo "<td>" . $row['dbpi1_tbveiculo_marcamodeloversao'] . "</td>";
                    echo "<td>" . $row['dbpi1_tbveiculo_anofabricmodelo'] . "</td>";
                    echo "<td><button onclick='editarRegistro(" . $row['dbpi1_tbveiculo_id'] . ")'>Atualizar</button>";
                    // echo "<button onclick='excluirRegistro(" . $row['dbpi1_tbveiculo_id'] . ")'>Excluir</button></td>";
                    echo "</tr>";
                }
            } catch(PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    // Função JavaScript para editar um registro
    function editarRegistro(id) {
        // Redireciona para a página de edição com o ID do registro
        window.location.href = "editar_registro_veiculo.php?id=" + id;
    }

    // Função JavaScript para excluir um registro
    function excluirRegistro(id) {
        if (confirm("Tem certeza que deseja excluir este registro?")) {
            // Envia uma requisição para excluir o registro e recarregar a página
            window.location.href = "excluir_registro_veiculo.php?id=" + id;
        }
    }
</script>

</body>
</html>
