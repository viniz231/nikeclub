<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Substitua pelo seu usuário do MySQL
$password = "rootroot"; // Substitua pela sua senha do MySQL
$dbname = "formulario_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Preparar e executar a inserção
    $sql = "INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem: " . $conn->error;
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
