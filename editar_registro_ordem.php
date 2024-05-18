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
        $sql = "SELECT * FROM dbpi1_tbordem WHERE dbpi1_tbordem_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o registro foi encontrado
        if ($registro) {
            // Se o registro foi encontrado, redireciona para a página de edição
            header("Location: editar_registro_ordem_form.php?id=" . $id);
            exit();
        } else {
            // Se o registro não foi encontrado, redireciona de volta para a página de exibição de registros
            header("Location: manutencao_ordens.php");
            exit();
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    // Se o ID não foi recebido, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_ordens.php");
    exit();
}
?>
