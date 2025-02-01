<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "EstoqueHamburgueria";
$password = "";
$dbname = "estoque_hamburgueria";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>

<!-- Adicionar item ao estoque -->
<?php
if (isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $sql = "INSERT INTO estoque (nome, quantidade) VALUES ('$nome', '$quantidade')";
    $conn->query($sql);
}
?>

<!-- Atualizar item do estoque -->
<?php
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    $sql = "UPDATE estoque SET quantidade='$quantidade' WHERE id='$id'";
    $conn->query($sql);
}
?>

<!-- Deletar item do estoque -->
<?php
if (isset($_POST['deletar'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM estoque WHERE id='$id'";
    $conn->query($sql);
}
?>

<!-- Listar itens do estoque -->
<?php
$sql = "SELECT * FROM estoque";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Controle de Estoque</title>
</head>
<body>
    <h2>Adicionar Item</h2>
    <form method="POST">
        Nome: <input type="text" name="nome" required>
        Quantidade: <input type="number" name="quantidade" required>
        <button type="submit" name="adicionar">Adicionar</button>
    </form>

    <h2>Estoque</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['quantidade'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="number" name="quantidade" value="<?= $row['quantidade'] ?>">
                        <button type="submit" name="atualizar">Atualizar</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="deletar">Deletar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
