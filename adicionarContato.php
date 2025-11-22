<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Cadastro</title>
    <link rel="stylesheet" href="estilos/adicionarCadastro.css">
</head>
<body>

    <main>
        <section id="log">
            <h1>MiniTask</h1>
            <h2>Adicionar Contato</h2>
            <form action="adicionarContato.php" method="POST">
                <label for="nome">Nome:</label>
                <br>
                <input type="text" name="nome" id="nome" class="adic" placeholder="Digite o Nome do Evento" required>
                <br>
                <label for="data">Data:</label>
                <br>
                <input type="date" name="data" id="data" class="adic" required>
                <br>
                <label for="time">Horário:</label>
                <br>
                <input type="time" name="time" id="time" class="adic" required>
                <label for="desc">Descrição:</label>
                <br>
                <input name="desc" id="desc" class="adic" placeholder="Digite aqui..."></input>
                <br>
                <input type="submit" value="Adicionar" class="adicionar">
            </form>
        </section>
        <section id="img3">
        </section>

    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include("conexao/conexao.php");
        
        $nome = $_POST['nome'];
        $date = $_POST['data'];
        $horario = $_POST['time'];
        $desc = $_POST['desc'];

        $sql = "INSERT INTO contatos (nome,data,horario,descricao) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$nome,$date,$horario,$desc);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("location:telaPrincipal.php");
    }
    ?>
    
</body>
</html>