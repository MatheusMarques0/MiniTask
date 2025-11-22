<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniTask</title>
    <link rel="stylesheet" href="estilos/telaPrincipal.css">
    <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon">
</head>
<body>
    <section id="coluna1">
        <h2>Funções</h2>
        <div id="menuIcone">
            <a href="editarPerfil.php">&#x1F464</a>
        </div>
    </section> <!--Primeira coluna-->

    <section id="coluna2">
        <div id="infogroup">
            <h2>MiniTask</h2>
            <form action="telaPrincipal.php" method="post"> <!--os comandos estarão nesta página-->
                <input type="text" name="buscar" id="buscar" placeholder="Procure o seu contato">
            </form>
        </div>
        <div class="contatos">
            <form action="telaPrincipal.php" method="post">
                <button type="submit" class="nome">Fulano</button>
            </form>
            <form action="deletarContato.php">
                <button type="submit" class="deletar"><a href="deletarContato.php">❌</a></button> <!--Esse botão deleta o contato-->
            </form>
        </div>
        <div id="adicionar"><a href="adicionarContato.php">➕</a></div> <!--Esse botão vai para a tela de adicionar-->
    </section> <!--Segunda coluna-->
    <main>
        <header>
            <h1>Descrição</h1>
        </header>
        <div id="sem_contato">
            <h2>Parece que não há niguém aqui... Adicione mais pessoas para os seus contatos!</h2>
        </div>
    </main> <!--Conteúdo Principal-->

    <?php

        include("conexao/conexao.php");
        
        $sql = "SELECT * FROM contatos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
                    
            while ($row = $resultado->fetch_assoc()) {
                    echo"
                        <section id='coluna2'>
                            <div class='contatos'>
                                <form action='telaPrincipal.php' method='post'>
                                <button type='submit' class='nome'>{$row['nome']}</button>
                                </form>
                                <form action='deletarContato.php'>
                                <button type='submit' class='deletar'><a href='deletarContato.php'>❌</a></button>
                                </form>
                            <div>
                        </section>
                                ";

        }
    }
    ?>

</body>
</html>