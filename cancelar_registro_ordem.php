<?php
// Verifica se o ID do registro a ser excluído foi recebido
if(isset($_GET["id"])) {
    // Obtém o ID do registro
    $id = $_GET["id"];
    $datadehoje = date("Y-m-d");

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbpi1";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query SQL para fechar o registro
        $sql = "UPDATE dbpi1_tbordem SET dbpi1_tbordem_status='Cancelada', dbpi1_tbordem_datacancelamento='$datadehoje' WHERE dbpi1_tbordem_id = :id AND dbpi1_tbordem_status='Aberta'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redireciona de volta para a página de exibição de registros
        header("Location: manutencao_ordens.php");
        exit();
    } catch(PDOException $e) {
        echo "Erro: Operação não realizada !" . $e->getMessage();
    }
} else {
    // Se o ID não foi recebido, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_ordens.php");
    exit();
}
?>
