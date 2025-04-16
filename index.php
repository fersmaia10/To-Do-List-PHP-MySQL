    <?php 
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require "src/connection.php";
        require "src/Model/Task.php";
        require "src/Repository/task_repository.php";

        $task_repository = new task_repository($pdo);
        $tasks = $task_repository->tasks_item();
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        if (isset($_POST['add'])) 
        {
            $task = new Task(null, $_POST['add']);

            $task_repository->insert($task);
            header("Location: index.php");
        }
    ?>
    <form method="post">
        <div>
            <input name= "add" type="search" placeholder="insira uma tarefa">
            <input type="submit" value="adicionar">
        </div>
    </form>
    <div>
        <?php foreach ($tasks as $task): ?>
    <!--aqui, é utilizado o método getDescription() para pegar o valor do objeto description, que é o que será exibido na tela -->
        <ul>
            <li>
                <span class="task_item"><?= $task->is_done() ? 'task_done' : ''?><?= $task->getDescription() ?></span> 
                <form action="delete_task.php" method="post">
                    <input type="hidden" name="id" value ="<?= $task->getId() ?>">
                    <input type="submit" value="Excluir">
                </form>

                <?php if (!$task->is_done()): ?>
                <form action="done_task.php" method="post">
                    <input type="submit" class="button_done" value="Concluir" onclick="done(this)">
                </form>
                <?php endif; ?>

                <a href="edit_task.php?id=<?= $task->getId()?>">Editar</a>
            </li>
        </ul>
        <?php endforeach;?>
    </div>
    <script src="app.js"></script>
</body>
</html>