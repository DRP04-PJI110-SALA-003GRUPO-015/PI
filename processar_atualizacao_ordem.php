<?php
// Verifica se os dados do formulário foram recebidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    
    if (isset($_POST["id"]) && isset($_POST["cliente_id"]) && isset($_POST["veiculo_id"]) && isset($_POST["dataabertura"]) && isset($_POST["descricaoservico"]) && isset($_POST["valorservicopeca"]) && isset($_POST["kilometragem"])) {

        // Obtém os dados do formulário
        $id = $_POST["id"];        
        $clienteid = $_POST["cliente_id"];
        $veiculoid = $_POST["veiculo_id"];
        $dataabertura = $_POST["dataabertura"];
        $descricaoservico = $_POST["descricaoservico"];
        $valorservicopeca = $_POST["valorservicopeca"];
        $kilometragem = $_POST["kilometragem"];
        
        
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "dbpi1";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query SQL para atualizar o registro            
            $sql = "UPDATE dbpi1_tbordem SET dbpi1_tbordem_clienteid = :clienteid, dbpi1_tbordem_veiculoid = :veiculoid, dbpi1_tbordem_dataabertura = :dataabertura, dbpi1_tbordem_descricaoservico = :descricaoservico, dbpi1_tbordem_valorservicopeca = :valorservicopeca, dbpi1_tbordem_kilometragem = :kilometragem WHERE dbpi1_tbordem_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':clienteid', $clienteid);
            $stmt->bindParam(':veiculoid', $veiculoid);
            $stmt->bindParam(':dataabertura', $dataabertura);
            $stmt->bindParam(':descricaoservico', $descricaoservico);
            $stmt->bindParam(':valorservicopeca', $valorservicopeca);
            $stmt->bindParam(':kilometragem', $kilometragem);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // Redireciona de volta para a página de exibição de registros
            header("Location: manutencao_ordens.php");
            exit();
        } catch(PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        // Se algum campo estiver faltando, redireciona de volta para a página de exibição de registros
        header("Location: manutencao_ordens.php");
        exit();
    }
} else {
    // Se os dados não foram recebidos via POST, redireciona de volta para a página de exibição de registros
    header("Location: manutencao_ordens.php");
    exit();
}
?>
