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
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1 class="task_title">Lista de Tarefas</h1>

    <?php 
        if (isset($_POST['add'])) 
        {
            $task = new Task(null, $_POST['add']);

            $task_repository->insert($task);
            header("Location: index.php");
        }
    ?>
    <form method="post" id="form_task">
        <div class="add_task">
            <input name= "add" type="search" id="entry_task" placeholder="insira uma tarefa">
            <input type="submit" id="add_button" class="add_button" value="Adicionar" onclick="verify_task()">
        </div>
    </form>       
    <!--aqui, é utilizado o método getDescription() para pegar o valor do objeto description, que é o que será exibido na tela -->
        <div class="task_list">
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <span class="task_item <?= $task->isDone() ? 'task_done' : ''?>">
                            <?= htmlspecialchars($task->getDescription()) ?>
                        </span>
                
                        <div class="all_buttons">
                            <form action="delete_task.php" method="post">
                                <input type="hidden" name="id" value ="<?= $task->getId() ?>">
                                <input type="submit" class="delete_button" value="Excluir">
                            </form>
                            <?php if (!$task->isDone()): ?>
                                <form action="done_task.php" method="post">
                                    <input type="hidden" name="id" value="<?= $task->getId() ?>">
                                    <input type="submit" class="done_button" value="Concluir">
                                </form>
                            <?php endif; ?>

                            <?php if (!$task->isDone()): ?>
                                <a href="edit_task.php?id=<?= $task->getId()?>">Editar</a>
                            <?php endif;    ?>
                        </div>
                    </li>
                </ul>
            <?php endforeach;?>
        </div>
    <script src="app.js"></script>
</body>
</html>