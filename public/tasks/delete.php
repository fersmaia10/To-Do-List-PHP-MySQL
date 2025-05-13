<?php 
    require "src/connection.php";
    require "src/Model/Task.php";
    require "src/Repository/TaskRepository.php";

    #metodo para deletar a tarefa
    $TaskRepository = new TaskRepository($pdo);
    $TaskRepository->delete($_POST['id']);

    header("Location: index.php");
?>