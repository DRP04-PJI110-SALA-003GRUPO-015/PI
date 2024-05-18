<?php
// Verifica se os dados do formulário foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST["id"]) && isset($_POST["cpfcnpj"]) && isset($_POST["nomerazao"]) && isset($_POST["endereco"]) && isset($_POST["telefone"]) && isset($_POST["email"])) {
    
        // Obtém os dados do formulário
        $id = $_POST["id"];
        $cpfcnpj = $_POST["cpfcnpj"];
        $nomerazao = $_POST["nomerazao"];
        $endereco = $_POST["endereco"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];

        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query SQL para atualizar o registro
            $sql = "UPDATE dbpi1_tbcliente SET dbpi1_tbcliente_cpfcnpj = :cpfcnpj, dbpi1_tbcliente_nomerazao = :nomerazao, dbpi1_tbcliente_endereco = :endereco, dbpi1_tbcliente_telefone = :telefone, dbpi1_tbcliente_email = :email WHERE dbpi1_tbcliente_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':cpfcnpj', $cpfcnpj);
            $stmt->bindParam(':nomerazao', $nomerazao);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Redireciona de volta para a página de exibição de registros
            header("Location: manutencao_clientes.php");
            exit();
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        // Se algum campo estiver faltando, redireciona de volta para a página de exibição de registros
        header("Location: manutencao_clientes.php");
        exit();
    }
} else {
    // Se os dados não foram recebidos via POST, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_clientes.php");
    exit();
}
?>
