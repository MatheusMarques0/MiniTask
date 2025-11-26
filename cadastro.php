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
            <h2>Cadastre-se para iniciar a sessão!</h2>
            <!--formulário de cadastro-->
            <form action="cadastro.php" method="POST">
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
                <h3>Como você está acessando?</h3>
                <div class="optiongroup">
                    <div class="option">
                        <input type="radio" name="tipo_usuario" id="cliente" class="radio">
                        <label for="cliente" class="labelgroup">Cliente</label>
                    </div>
            
                    <div class="option">
                        <input type="radio"name="tipo_usuario"id="prestador" class="radio">
                        <label for="prestador"class="labelgroup">Prestador<label>
                    </div>
                </div>
                <br>
                <input type="submit" value="Cadastrar" class="cadastro">
            </form>
            <a href="login.php" class="link">Já tem uma conta?</a>
        </section>
        <section id="img">
        </section>
    </main>

    <?php

       try {
       if($_SERVER["REQUEST_METHOD"] == "POST") {
        include("conexao/conexao.php"); 

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "INSERT INTO usuarios (nome,email,senha) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$nome,$email,$senha);
        $stmt->execute();
        $stmt->close(); 
        $conn->close();
        header("location:telaPrincipal.php");
       }

       }

       catch(mysqli_sql_exception $e){

        if (str_contains($e->getMessage(), "Duplicate entry")) {

            echo "<div>E-mail já está cadastrado</div>";
        } else {
            echo "<div>Erro ao cadastrar, Tente novamente mais tarde</div>";
        }
        echo $e->getMessage();
       }
    ?>

</body>
</html>