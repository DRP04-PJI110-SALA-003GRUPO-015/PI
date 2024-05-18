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
			<h2>Manutenção de Veículos - Inclusão</h2>	
            <nav>
			    <a href="menu_veiculos.php"> Retorna 'Menu de Veículos'</a>		
            </nav>
		</header>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    		    Placa: <input type="text" name="placa" maxlength="7" placeholder="XXX9999" required> <br> <br>
	    		Marca / Modelo / Versão: <input type="text" name="marcamodeloversao" maxlength="40" placeholder="Marca / Modelo / Versão" required> <br> <br>
		    	Ano fabricação / Ano modelo: <input type="number" name="anofabricmodelo" maxlength="8" placeholder="88889999" required> <br> <br>
			    <br>
    		    <input type="submit" value="Incluir">
    		    <input type="button" value="Cancelar" onclick="window.location.href='menu_veiculos.php'">
		</form>
        
	</body>
            
</html>

