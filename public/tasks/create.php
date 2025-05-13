    <?php 
       declare(strict_types=1);
        
        require __DIR__ . "/../../src/connection.php";
        require __DIR__ . "/../../src/Model/Task.php";
        require __DIR__ . "/../../src/Repository/TaskRepository.php";


        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return json_encode(['mesage' => 'Método não permitido']);
            http_response_code(404);
            exit;
        }

        if (isset($_POST['add']))
        {

        }

        $TaskRepository = new TaskRepository($pdo);
       
        $task = new Task(null, $_POST['add']);
        
        $TaskRepository->insert($task);