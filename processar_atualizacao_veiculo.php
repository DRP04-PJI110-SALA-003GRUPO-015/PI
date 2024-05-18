<?php
// Verifica se os dados do formulário foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST["id"]) && isset($_POST["placa"]) && isset($_POST["marcamodeloversao"]) && isset($_POST["anofabricmodelo"])) {
        // Obtém os dados do formulário
        $id = $_POST["id"];
        $placa = $_POST["placa"];
        $marcamodeloversao = $_POST["marcamodeloversao"];
        $anofabricmodelo = $_POST["anofabricmodelo"];
    
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query SQL para atualizar o registro
            $sql = "UPDATE dbpi1_tbveiculo SET dbpi1_tbveiculo_placa = :placa, dbpi1_tbveiculo_marcamodeloversao = :marcamodeloversao, dbpi1_tbveiculo_anofabricmodelo = :anofabricmodelo WHERE dbpi1_tbveiculo_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':placa', $placa);
            $stmt->bindParam(':marcamodeloversao', $marcamodeloversao);
            $stmt->bindParam(':anofabricmodelo', $anofabricmodelo);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Redireciona de volta para a página de exibição de registros
            header("Location: manutencao_veiculos.php");
            exit();
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        // Se algum campo estiver faltando, redireciona de volta para a página de exibição de registros
        header("Location: manutencao_veiculos.php");
        exit();
    }
} else {
    // Se os dados não foram recebidos via POST, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_veiculos.php");
    exit();
}
?>
