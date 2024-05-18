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

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para obter os dados do registro
            $sql = "SELECT * FROM dbpi1_tbusuario WHERE dbpi1_tbusuario_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $registro = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se o registro foi encontrado
            if ($registro) {
                // Exibe o formulário de edição com os dados do registro
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
			<h2>Manutenção de Usuarios - Atualização</h2>	
            <nav>
			    <a href="manutencao_usuarios.php"> Retorna 'Manutenção de Usuários'</a>		
            </nav>
	</header>
    <br>

<body>

<form action="processar_atualizacao_usuario.php" method="post">
    <input type="hidden" name="id" value="<?php echo $registro['dbpi1_tbusuario_id']; ?>">
    Nome: <input type="text" maxlength=40 name="nome" required value="<?php echo $registro['dbpi1_tbusuario_nome']; ?>"><br><br>
    Cargo: <input type="text" maxlength=20 name="cargo" required value="<?php echo $registro['dbpi1_tbusuario_cargo']; ?>"><br><br>
    Departamento: <input type="text" maxlength=20 name="departamento"  required value="<?php echo $registro['dbpi1_tbusuario_departamento']; ?>"><br><br>
    Senha: <input type="password" maxlength=6 name="senha" required value="<?php echo $registro['dbpi1_tbusuario_senha']; ?>"><br><br>
    <input type="submit" value="Atualizar">
</form>

</body>
</html>
<?php
        } else {
            // Se o registro não foi encontrado, redireciona de volta para a página de exibição de registros
            header("Location: manutencao_usuarios.php");
            exit();
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Se o ID não foi recebido, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_usuarios.php");
    exit();
}
?>
