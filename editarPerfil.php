<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="estilos/editarPerfil.css">
</head>
<body>

    <main>
        <section id="log">
            <h1>MiniTask</h1>
            <h2>Atualizar Perfil</h2>
            <!--formulário de atualização-->
            <form action="editarPerfil.php" method="post">
                <label for="nome">Nome:</label>
                <br>
                <input type="text" name="nome" id="nome" class="atuali" placeholder="Digite seu nome" required>
                <br>
                <label for="email">E-mail:</label>
                <br>
                <input type="email" name="email" id="email" class="atuali" placeholder="Digite o seu e-mail" required>
                <br>
                <label for="senha">Senha:</label>
                <br>
                <input type="password" name="senha" id="senha" class="atuali" placeholder="*******" minlength="8" required>
                <br>
                <h3>Como deseja acessar?</h3>
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
                <input type="submit" value="Atualizar" class="atualizar">
            </form>
        </section>
    

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
        include("conexao/conexao.php");

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "UPDATE usuarios
            SET nome = ?,
                email = ?,
                senha = ?
            WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$nome,$email,$senha,$email);
        $stmt->execute();
        $stmt->close(); 
        $conn->close();
        header("location:telaPrincipal.php");
    }
    ?>
</body>
</html>