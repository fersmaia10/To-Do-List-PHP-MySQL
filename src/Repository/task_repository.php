<?php 
    class task_repository
    {
        private PDO $pdo;
        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        private function forming_task($task_data)
        {
            return new Task($task_data['id'], $task_data['description'], (bool)$task_data['done']);
        }

        #essa funcao retorna todas as tarefas do banco de dados em um array de objetos
        public function tasks_item(): array
        {
            $sql = 'SELECT * FROM tasks';
            $statement = $this->pdo->query($sql);
            $tasks_list = $statement->fetchAll(PDO::FETCH_ASSOC);

            $task_data = array_map(function($task) {
                return $this->forming_task($task);
            }, $tasks_list);

            return $task_data;
        }

        #funcao para deletar uma tarefa do banco de dados
        #a função delete recebe o id da tarefa a ser deletada e executa um comando SQL DELETE
        public function delete(int $id){
            $sql = 'DELETE FROM tasks WHERE id = ?';
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id);
            $statement->execute();
        }

        #essa função insere uma nova tarefa no banco de dados
        public function insert(Task $task): void
        {
            $sql = 'INSERT INTO tasks (description) VALUES (?)';
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $task->getDescription());
            $statement->execute();
        }

        #função de selecionar apenas uma tarefa para a função editar e concluir
        public function select_one(int $id)
        {
            $sql = 'SELECT * FROM tasks WHERE id = ?';
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $id);
            $statement->execute();
            $task_data = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->forming_task($task_data);
        }

        public function update(Task $task)
        {
            $sql = 'UPDATE tasks SET description = ? WHERE id = ?';
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(1, $task->getDescription());
            $statement->bindValue(2, $task->getId());
            $statement->execute();
        }
    }

?>