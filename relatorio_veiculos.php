<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PI1 - SUPER TROCA DE ÓLEO</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Conexão com o banco de dados
$servername = "localhost"; // Altere conforme necessário
$username = "root"; // Altere conforme necessário
$password = ""; // Altere conforme necessário
$dbname = "dbpi1"; // Nome do banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para selecionar todos os registros da tabela
$sql = "SELECT * FROM dbpi1_tbveiculo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<hr>";
    echo "<h2>UNI-EMPRESA SERVIÇOS LTDA</h2>";
    echo "<h2>Relatório - Cadastro de veículos</h2>";
    echo "<hr>";
    echo "<br>";
    echo "<table>";
    echo "<tr><th>ID</th><th>PLACA</th><th>MARCA / MODELO / VERSÃO</th><th>FABRICAÇÃO / MODELO</th><th>KILOMETRAGEM</th></tr>";
    // Output data de cada linha
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["dbpi1_tbveiculo_id"]."</td><td>".$row["dbpi1_tbveiculo_placa"]."</td><td>".$row["dbpi1_tbveiculo_marcamodeloversao"]."</td><td>".$row["dbpi1_tbveiculo_anofabricmodelo"]."</td><td>".$row["dbpi1_tbveiculo_kilometragem"]."</td></tr>";
    }
    echo "</table>";
    echo "<br>";
    echo "<h6>Emitido em: " . date("d/m/Y H:i:s") . "</h6>";
    echo "<br>";
    echo "<button onclick=\"window.print();\">Imprimir</button>";
} else {
    echo "0 resultados encontrados.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

</body>
</html>
