<?php
// Verifica se os dados do formulário foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST["id"]) && isset($_POST["nome"]) && isset($_POST["cargo"]) && isset($_POST["departamento"]) && isset($_POST["senha"])) {
        // Obtém os dados do formulário
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $cargo = $_POST["cargo"];
        $departamento = $_POST["departamento"];
        $senha = $_POST["senha"];

        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query SQL para atualizar o registro
            $sql = "UPDATE dbpi1_tbusuario SET dbpi1_tbusuario_nome = :nome, dbpi1_tbusuario_cargo = :cargo, dbpi1_tbusuario_departamento = :departamento, dbpi1_tbusuario_senha = :senha WHERE dbpi1_tbusuario_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cargo', $cargo);
            $stmt->bindParam(':departamento', $departamento);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Redireciona de volta para a página de exibição de registros
            header("Location: manutencao_usuarios.php");
            exit();
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        // Se algum campo estiver faltando, redireciona de volta para a página de exibição de registros
        header("Location: manutencao_usuarios.php");
        exit();
    }
} else {
    // Se os dados não foram recebidos via POST, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_usuarios.php");
    exit();
}
?>
