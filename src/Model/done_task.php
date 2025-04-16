<?php
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];

    $sql = "UPDATE tasks SET done = 1 WHERE id = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([$id]);

    header("Location: index.php"); // redireciona de volta
    exit();
}
?>
