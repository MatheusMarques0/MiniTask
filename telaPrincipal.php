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
        <div id='contato'>
        <!--É aqui onde ficará os contatos, o php, fará o comando HTML -->
                <?php

        include("conexao/conexao.php");
        
        $sql = "SELECT * FROM contatos";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
                    
            while ($row = $resultado->fetch_assoc()) {
                    echo"
                            <div class='contatos'>
                                <form action='telaPrincipal.php' method='post'>
                                <button type='submit' class='nome'>{$row['nome']}</button>
                                </form>
                                <form action='deletarContato.php'>
                                <button type='submit' class='deletar'><a href='deletarContato.php'>❌</a></button>
                                </form>
                            </div>
                                ";

        }
    }
    ?>
        </div>
        <div id="adicionar"><a href="adicionarContato.php">➕</a></div> <!--Esse botão vai para a tela de adicionar-->
    </section> <!--Segunda coluna-->
    <main>
        <header>
            <h1>Descrição</h1>
        </header>

        <?php
        // Quando o nome do contato é clicado:
        if (isset($_POST['id_contato'])) {

            $id = $_POST['id_contato'];

            $sql = "SELECT * FROM contatos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $contato = $resultado->fetch_assoc();

                echo "
                <div id='descricao_contato'>
                    <h2>{$contato['nome']}</h2>
                    <p>{$contato['descricao']}</p>
                </div>";
            }
        } else {
            echo "
            <div id='sem_contato'>
                <h2>Parece que não há ninguém aqui...  
                Clique em um contato para ver a descrição!</h2>
            </div>";
        }
        ?>
    </main> 
</body>
</html>