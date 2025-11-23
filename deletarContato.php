<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deletar Conta - MiniTask</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon">
</head>
<body>
    <main>
        <section id="log">
            <h1>MiniTask</h1>
            <h2>deletar minha conta</h2>
            <p class="aviso">Atenção: esta ação é irreversível!<br>Todos os seus dados e tarefas serão apagados permanentemente.</p>

            <?php
            session_start();

            
            if (!isset($_SESSION['usuario_id'])) {
                header("Location: login.php");
                exit();
            }

            $usuario_id = $_SESSION['usuario_id'];
            $mensagem = "";

            
            try {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include("conexao/conexao.php");

                    
                    $senha_digitada = $_POST["senha_confirmacao"] ?? '';

                    
                    $sql = "SELECT senha FROM usuarios WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $usuario_id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    $usuario = $resultado->fetch_assoc();
                    $stmt->close();

                    
                    if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {

                        //
                        $sql_tarefas = "DELETE FROM tarefas WHERE usuario_id = ?";
                        $stmt_tarefas = $conn->prepare($sql_tarefas);
                        $stmt_tarefas->bind_param("i", $usuario_id);
                        $stmt_tarefas->execute();
                        $stmt_tarefas->close();

                        
                        $sql_usuario = "DELETE FROM usuarios WHERE id = ?";
                        $stmt_usuario = $conn->prepare($sql_usuario);
                        $stmt_usuario->bind_param("i", $usuario_id);
                        $stmt_usuario->execute();
                        $stmt_usuario->close();
                        $conn->close();

                        // Destroi a sessão e redireciona
                        session_destroy();
                        header("Location: login.php?excluido=1");
                        exit();
                    } else {
                        $mensagem = "<div class='erro'>Senha incorreta. Tente novamente.</div>";
                    }
                }
            } catch (mysqli_sql_exception $e) {
                $mensagem = "<div class='erro'>Erro ao excluir conta. Tente novamente mais tarde.</div>";
                error_log($e->getMessage()); // opcional: log do erro
            }
            ?>

            <?= $mensagem ?>

            <form action="deletar-cadastro.php" method="POST">
                <label for="senha_confirmacao">Digite sua senha para confirmar a exclusão:</label>
                <br>
                <input type="password" name="senha_confirmacao" id="senha_confirmacao" class="cadas" placeholder="*******" required minlength="8">
                <br><br>

                <input type="submit" value="Excluir minha conta permanentemente" class="botao-excluir">
                <a href="telaPrincipal.php" class="botao-cancelar">Cancelar e voltar</a>
            </form>

            <br>
            <a href="telaPrincipal.php" class="link">Voltar para a página inicial</a>
        </section>

        <section id="img">
            <!-- mesma imagem de fundo ou ilustração que você já usa -->
        </section>
    </main>
</body>
</html>