<?php
// Configuração de conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuário do MySQL
$password = "rootroot"; // Substitua pela sua senha do MySQL
$dbname = "pesquisa_db";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegando os valores do formulário
    $name = $_POST["name"];
    $gender = $_POST["radio"];
    $city = $_POST["select"];
    $age = intval($_POST["number"]);
    $email = $_POST["email"];
    $telephone = $_POST["tel"];
    $message = $_POST["message"];

    // Preparando e executando a inserção de dados
    $sql = "INSERT INTO survey_responses (name, gender, city, age, email, telephone, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisss", $name, $gender, $city, $age, $email, $telephone, $message);

    if ($stmt->execute()) {
        echo "Dados salvos com sucesso!";
    } else {
        echo "Erro ao salvar os dados: " . $conn->error;
    }

    // Fechando a conexão
    $stmt->close();
    $conn->close();
}
?>
