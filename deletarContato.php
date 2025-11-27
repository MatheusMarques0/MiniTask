<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Contato</title>
    <link rel="stylesheet" href="estilos/deletarCadastro.css">
    <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon">
</head>
<body>

    <main>
        <section id="log">
            <h1>MiniTask</h1>
            <h2>Excluir Contato</h2>

            <?php
            session_start();
            include("conexao/conexao.php");

            // Se não veio com ID, volta pra tela principal
            if (!isset($_POST['id_contato']) && !isset($_GET['confirmar'])) {
                header("Location: telaPrincipal.php");
                exit();
            }

            $id = isset($_POST['id_contato']) ? (int)$_POST['id_contato'] : (int)$_GET['confirmar'];
            $nome_contato = "este contato";

            // Busca o nome do contato para exibir
            $sql = "SELECT nome FROM contatos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($row = $resultado->fetch_assoc()) {
                $nome_contato = htmlspecialchars($row['nome']);
            }
            $stmt->close();

            // Se confirmou a exclusão via GET
            if (isset($_GET['confirmar']) && $_GET['confirmar'] == $id) {
                $sql_delete = "DELETE FROM contatos WHERE id = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("i", $id);
                $stmt_delete->execute();
                $stmt_delete->close();
                $conn->close();
                header("Location: telaPrincipal.php");
                exit();
            }
            ?>

            <div class="confirmacao">
                <p>Tem certeza que deseja excluir permanentemente o contato:</p>
                <p class="nome-excluir"><strong>"<?php echo $nome_contato; ?>"</strong></p>
                <p>Esta ação <strong>não poderá ser desfeita</strong>.</p>
            </div>

            <div class="botoes">
                <!-- Botão SIM: confirma exclusão -->
                <a href="deletarContato.php?confirmar=<?php echo $id; ?>">
                    <input type="button" value="Sim, Excluir" class="deletar sim">
                </a>

                <!-- Botão NÃO: volta sem excluir -->
                <form action="telaPrincipal.php" method="post" style="display: inline;">
                    <input type="submit" value="Não, Cancelar" class="deletar nao">
                </form>
            </div>

        </section>

        <section id="img3">
            <!-- Imagem de fundo (você já usa isso em adicionarContato) -->
        </section>
        <section></section>
    </main>

<?php
$conn->close();
?>
</body>
</html>

//quero dormir