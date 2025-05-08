<?php 

    # esse é um arquivo de classe que consiste tudo o que haverá no meu item inserido no banco de dados
    # no caso desse projeto, os obejetos dessa classe são id e description
    class Task
    {
        private ?int $id;
        private string $description;
        private bool $done; #done criado para captar o estado da tarefa

        #depois da definição dos objetos, é adicionado um contrutor para inicializa-los
        public function __construct(?int $id, string $description, bool $done =  false)
        {
            $this->id = $id;
            $this->description = $description;
            $this->done = $done;
        }

        #depois, são criados os métodos get para cada objeto, que serão utilizados para pegar os valores dos objetos
        public function getId(): int
        {
            return $this->id;
        }

        public function getDescription(): string
        {
            return $this->description;
        }

        public function isDone(): bool 
        {
            return $this->done;
        }

        public function setDone($done) {
            $this->done = $done;
        }

    }

?>