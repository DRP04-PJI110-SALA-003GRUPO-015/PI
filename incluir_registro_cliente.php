<?php
// Verifica se os dados foram enviados via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todas as variáveis necessárias foram enviadas
    if (isset($_POST['nome']) && isset($_POST['cargo']) && isset($_POST['departamento']) && isset($_POST['senha'])) {
        // Captura os valores enviados pelo formulário
        $nome = $_POST['nome'];
        $cargo = $_POST['cargo'];
        $departamento = $_POST['departamento'];
        $senha = $_POST['senha'];

        // Configurações do banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        // Conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Prepara e executa a consulta SQL para inserir o novo registro
        $sql = "INSERT INTO dbpi1_tbusuario (dbpi1_tbusuario_nome, dbpi1_tbusuario_cargo, dbpi1_tbusuario_departamento, dbpi1_tbusuario_senha)
                VALUES ('$nome', '$cargo', '$departamento', '$senha')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo registro inserido com sucesso!";
        } else {
            echo "Erro ao inserir novo registro: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Erro: Todos os campos devem ser preenchidos.";
    }
} else {
    echo "Erro: Método de requisição inválido.";
}
?>
