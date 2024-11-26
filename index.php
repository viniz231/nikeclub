<?php
// Inicia a sessão para verificar se o usuário está logado
session_start();

// Verifica se a sessão do usuário está ativa (se o e-mail foi armazenado na sessão)
$usuario_email = isset($_SESSION['usuario_email']) ? $_SESSION['usuario_email'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Downy Shoes</title>
    <link rel="shortcut icon" type="image/x-icon" href="Images/img-DS.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/preloader.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="./js/preloader.js"></script>
    <style>
      .oie {
            background-color: cadetblue;
            color: white;
            border: none;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
            transition: background-color 0.3s;
            font-family: "Montserrat";
      }
    </style>
</head>
<body>
    <div class="se-pre-con"></div>
    <header id="home">
        <nav>
            <ul>
                <li class="primary-nav">
                    <img src="Images/Design sem nome.jpg" alt="logo" />
                    <a href="#home">NIKE CLUB</a>
                </li>
                <li class="secondary-nav"><a href="HTML/women.html">MULHER</a></li>
                <li class="secondary-nav"><a href="HTML/men.html">HOMEM</a></li>
                <li class="secondary-nav"><a href="HTML/about-us.html">SOBRE NÓS</a></li>
                <li class="secondary-nav"><a href="projeto_integrado/indexx.html">CADASTRE-SE</a></li>
            </ul>
        </nav>
        <div class="pxtext">
            <span class="border">Nike Air Jordan</span>
        </div>
    </header>

    <section>
        <?php
        // Se o usuário estiver logado, exibe a mensagem de boas-vindas com o e-mail
        if ($usuario_email) {
            echo "<div style='text-align: center; padding: 20px;'>";
            echo "<h3>Seja bem-vindo, " . htmlspecialchars($usuario_email) . "!</h3>";
            echo "</div>";
        } else {
            echo "<div style='text-align: center; padding: 20px;'>";
            echo "<h3>Faça login para continuar</h3>";
            echo "</div>";
        }
        ?>
    </section>

    <section>
        <div class="row" style="width: 80%; margin: 0 auto;">
            <div class="col">
                <div class="overlay-image">
                    <a href="HTML/men.html">
                        <img class="image" src="./Images/img-men6.jpg" alt="Alt text" />
                        <div class="normal">
                            <div class="text">HOMEM</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="overlay-image">
                    <a href="HTML/women.html">
                        <img class="image" src="./Images/img-women5.jpeg" alt="Alt text" />
                        <div class="normal">
                            <div class="text">MULHER</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="row foot">
            <div class="col">
                <h1>NIKE CLUB</h1>
                <p>SITE OFICIAL DA <a href="https://www.nike.com/xf/en_gb/">NIKE</a></p>
            </div>
            <div class="col">
                <h2>Links</h2>
                <ul>
                    <li><a href="./HTML/Contact-us.html">Entre em contato</a></li>
                </ul>
            </div>
        </div>
        <div class="user-actions" style="text-align: center; padding: 20px;">
            <?php
            // Se o usuário estiver logado, exibe as ações do usuário no rodapé
            if ($usuario_email) {
                echo "<h2>Ações do Usuário</h2>";
                echo "<button class='oie' id='btn-alterar' onclick='alterarCadastro()'>Alterar Login/Senha</button><br><br>";
                echo "<button id='btn-excluir' onclick='excluirCadastro()'>Excluir Cadastro</button><br><br>";
                echo "<h3><a href='./HTML/survey.html'>Clique aqui para responder a uma pesquisa rápida</a></h3>";
            }
            ?>
        </div>
    </footer>

    <script>
        // Função para alterar o cadastro (login e senha)
        function alterarCadastro() {
            const novoLogin = prompt("Digite o novo login (e-mail):");
            const novaSenha = prompt("Digite a nova senha:");

            if (novoLogin && novaSenha) {
                // Enviar a solicitação para o backend (PHP) para atualizar o banco de dados
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "alterar_cadastro.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Atualiza a tela com o novo login (e-mail)
                        document.querySelector("h3").innerHTML = "Seja bem-vindo, " + novoLogin + "!";
                        alert("Cadastro alterado com sucesso!");
                    }
                };
                // Envia os dados via POST para o PHP
                xhr.send("login=" + novoLogin + "&senha=" + novaSenha);
            }
        }

        // Função para excluir o cadastro
        function excluirCadastro() {
            if (confirm("Tem certeza que deseja excluir seu cadastro? Esta ação não pode ser desfeita.")) {
                // Enviar a solicitação para o backend (PHP) para excluir o cadastro do banco de dados
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "excluir_cadastro.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert("Cadastro excluído com sucesso!");
                        window.location.href = "index.php"; // Redireciona para a página inicial
                    }
                };
                // Envia a requisição para excluir o cadastro (sem dados adicionais)
                xhr.send();
            }
        }
    </script>
</body>
</html>
