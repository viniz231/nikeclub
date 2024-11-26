<?php
session_start();

// Verifica se o e-mail está armazenado na sessão
if (isset($_SESSION['usuario_email'])) {
    // Obtém o e-mail do usuário logado
    $usuario_email = $_SESSION['usuario_email'];

    // Conecta ao banco de dados (ajuste suas credenciais conforme necessário)
    $servername = "localhost";
    $username = "root"; // Substitua pelo seu nome de usuário do banco de dados
    $password = "rootroot"; // Substitua pela sua senha
    $dbname = "cadastro_db"; // Substitua pelo nome do seu banco de dados

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara a query para excluir o usuário baseado no login (e-mail)
    $sql = "DELETE FROM usuarios WHERE login = ?";

    // Prepara a declaração
    if ($stmt = $conn->prepare($sql)) {
        // Associa o parâmetro (login do usuário)
        $stmt->bind_param("s", $usuario_email); // "s" significa string

        // Executa a query
        if ($stmt->execute()) {
            // Exclui a sessão do usuário após excluir o cadastro
            session_destroy(); // Destroi a sessão para encerrar o login

            echo "Cadastro excluído com sucesso!";
        } else {
            echo "Erro ao excluir o cadastro: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro ao preparar a query: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "Nenhum usuário logado.";
}
?>
