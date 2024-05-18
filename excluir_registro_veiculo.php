<?php
// Verifica se o ID do registro a ser excluído foi recebido
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

        // Query SQL para excluir o registro
        $sql = "DELETE FROM dbpi1_tbveiculo WHERE dbpi1_tbveiculo_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redireciona de volta para a página de exibição de registros
        header("Location: manutencao_veiculos.php");
        exit();
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Se o ID não foi recebido, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_veiculos.php");
    exit();
}
?>
