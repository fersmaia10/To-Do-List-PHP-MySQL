<?php 
    require 'src/connection.php';
    require 'src/Model/Task.php';
    require 'src/Repository/task_repository.php';


    $task_repository = new task_repository($pdo);

    if (isset($_POST['edit'])) {
        $task = new Task($_GET['id'], $_POST['description']);
        $task_repository->update($task);
        header('Location: index.php');
    } 
    
    else
    {
        $task = $task_repository->select_one($_GET['id']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <form method="post">
        <div>
            <input name="description" type="text" value="<?= $task->getDescription() ?>">
            <input name="edit" type="submit" value="Salvar">
        </div>
    </form>
</body>
</html>