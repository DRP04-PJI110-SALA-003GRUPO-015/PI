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

// Consulta SQL para selecionar os registros da tabela "dbpi1_tbordem" com informações relacionadas de outras tabelas
$sql = "SELECT o.dbpi1_tbordem_id, v.dbpi1_tbveiculo_placa, v.dbpi1_tbveiculo_marcamodeloversao, c.dbpi1_tbcliente_nomerazao, o.dbpi1_tbordem_dataabertura, o.dbpi1_tbordem_status
FROM dbpi1_tbordem o
INNER JOIN dbpi1_tbcliente c ON o.dbpi1_tbordem_clienteid = c.dbpi1_tbcliente_id
INNER JOIN dbpi1_tbveiculo v ON o.dbpi1_tbordem_veiculoid = v.dbpi1_tbveiculo_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<hr>";
    echo "<h2>UNI-EMPRESA SERVIÇOS LTDA</h2>";
    echo "<h2>Relatório - Cadastro de ordens de serviço (geral)</h2>";
    echo "<hr>";
    echo "<br>";
    echo "<table>";
    echo "<tr><th>ID da Ordem</th><th>Placa do Veículo</th><th>Marca/Modelo/Versão</th><th>Nome/Razão do Cliente</th><th>Data de Abertura</th><th>Status</th></tr>";
    
    // Output data de cada linha
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["dbpi1_tbordem_id"]."</td>";
        echo "<td>".$row["dbpi1_tbveiculo_placa"]."</td>";
        echo "<td>".$row["dbpi1_tbveiculo_marcamodeloversao"]."</td>";
        echo "<td>".$row["dbpi1_tbcliente_nomerazao"]."</td>";
        echo "<td>".$row["dbpi1_tbordem_dataabertura"]."</td>";
        echo "<td>".$row["dbpi1_tbordem_status"]."</td>";
        echo "</tr>";
    }    
    echo "<table>";
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
