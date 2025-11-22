<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectar</title>
    <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon">
     <style>
        #img2{
        width: 300px;
        height: 550px;
        background-image: url(imagens/MiniTask_Conectar.png);
        background-position: center;
        background-size: cover;
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
        }
    </style>
</head>
<body>
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon"> <!--Favicon-->

</head>
<body>
    <main>
        <section id="log">
            <h1>MiniTask</h1>
            <h2>Entre no MiniTask com a sua conta!</h2>
            <!--formulário de cadastro-->
            <form action="telaPrincipal.php" method="POST">
                <label for="nome">Nome:</label>
                <br>
                <input type="text" name="nome" id="nome" class="cadas" placeholder="Digite seu nome" required>
                <br>
                <label for="email">E-mail:</label>
                <br>
                <input type="email" name="email" id="email" class="cadas" placeholder="Digite o seu e-mail" required>
                <br>
                <label for="senha">Senha:</label>
                <br>
                <input type="password" name="senha" id="senha" class="cadas" placeholder="*******" minlength="8" required>
                <br>
                </div>
                <br>
                <input type="submit" value="Entrar" class="cadastro">
            </form>
            <a href="cadastro.php" class="link">Não tem uma conta?</a>
        </section>
        <section id="img2">
        </section>
    </main>

    <?php

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            include("conexao/conexao.php");

            $nome = $_POST['nome'];

            $sql = "SELECT nome FROM usuarios WHERE nome = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($resultado == $nome) {
                header("location: telaPrincipal.php");
            }
        }

    ?>

</body>
</html>
</body>
</html>