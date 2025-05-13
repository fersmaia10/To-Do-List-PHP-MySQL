<?php
require "src/connection.php";
require "src/Model/Task.php";
require "src/Repository/TaskRepository.php";

$TaskRepository = new TaskRepository($pdo);

// Verifica se a requisição é POST e se o ID foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Busca a tarefa
    $task = $TaskRepository->select_one($id);
    if (!$task) {
        // Tarefa não encontrada — redireciona com erro
        header("Location: index.php?error=notfound");
        exit;
    }

    // Marca como concluída
    $task->setDone(true);

    // Atualiza no banco de dados
    $sql = 'UPDATE tasks SET done = 1 WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Redireciona de volta para a página principal
    header("Location: index.php");
    exit;
} 

else {
    // Requisição inválida — redireciona com erro
    header("Location: index.php?error=invalid");
    exit;
}
