<?php 
    require "src/connection.php";
    require "src/Model/Task.php";
    require "src/Repository/task_repository.php";

    #metodo para deletar a tarefa
    $task_repository = new task_repository($pdo);
    $task_repository->delete($_POST['id']);

    header("Location: index.php");
?>