<?php
// Verifica se os dados do formulário foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verifica se todos os campos necessários foram preenchidos    
    if (isset($_POST["username"]) && isset($_POST["password"]) ) {

        // Obtém os dados do formulário
        $usuario = $_POST["username"];        
        $senha = $_POST["password"];
        
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        // Consulta SQL para obter os dados do usuario
        $sql_usuario = "SELECT * FROM dbpi1_tbusuario WHERE dbpi1_tbusuario_id = $usuario";
        $result_usuario = $conn->query($sql_usuario);
        // Verifica se há resultados
        if ($result_usuario->num_rows > 0) {
           // Obtem o registro
           $row = $result_usuario->fetch_assoc();
           $var_usuarioid = $row["dbpi1_tbusuario_id"];
           $var_usuariosenha = $row['dbpi1_tbusuario_senha'];           
           if ($senha == $var_usuariosenha) {
                echo "<form action='menu_principal.php' method='post'>";
                echo "<input type='submit' value='USUARIO VALIDADO - CLIQUE AQUI PARA ACESSAR O SISTEMA !!!'>";
                echo "</form>";
            } else {
                echo "<form action='index.php' method='post'>";
                echo "<input type='submit' value='SENHA INCORRETA - CLIQUE AQUI PARA RETORNAR !!!'>";
                echo "</form>";
            }                       
        } else {
            echo "<form action='index.php' method='post'>";
            echo "<input type='submit' value='USUARIO NÃO CADASTRADO !!!'>";
            echo "</form>";
        }     
    
    } else {
        // Se algum campo estiver faltando, redireciona de volta para a página de exibição de registros
        header("Location: index.php");
        exit();
    }
} else {
    // Se os dados não foram recebidos via POST, redireciona de volta para a página de exibição de registros
    header("Location: index.php");
    exit();
}

?>
