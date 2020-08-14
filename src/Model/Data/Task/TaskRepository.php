<?php


namespace Model\Data\Task;


use Core\Connection;
use Model\Domain\Task\TaskAbstract;
use Model\Domain\Task\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    private $connection;


    /**
     * TaskRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function createTask(): TaskAbstract
    {
        return new Task();
    }

    public function save(TaskAbstract $task)
    {
        if ($task->getId()) {
            $sql = "UPDATE tasks SET username = ?,email = ?, text = ?, status = ?, edited = ? WHERE id = {$task->getId()}";
        } else {
            $sql = "INSERT INTO tasks (username, email, text,status,edited) VALUES (?,?,?,?,?)";
        }
        $pdo = $this->connection->createPdo();
        $pdo->prepare($sql)->execute([
            $task->getUserName(),
            $task->getEmail(),
            $task->getText(),
            $task->getStatus(),
            $task->getEdited()
        ]);
    }

    public function findAll(int $offset = 0, int $limit = 3, $order = "id", $direction = "desc")
    {
        if (!in_array($order, ['email', 'username', 'status']) || !in_array($direction, ["desc", "asc"])) {
            $order = "id";
            $direction = "DESC";
        }
        $pdo = $this->connection->createPdo();
        $stmt = $pdo->query("SELECT * FROM tasks ORDER BY {$order} {$direction} LIMIT {$offset}, {$limit}");

        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = $this->mapRow($row);
        }
        return $result;
    }

    public function getTotalCount(): int
    {
        $pdo = $this->connection->createPdo();
        $stmt = $pdo->query("SELECT count(*) FROM tasks");
        return $stmt->fetchColumn(0);
    }

    public function find($id): ?TaskAbstract
    {
        $pdo = $this->connection->createPdo();
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $this->mapRow($stmt->fetch());
    }

    /**
     * @param $row
     * @return TaskAbstract
     */
    private function mapRow($row): TaskAbstract
    {
        $task = $this->createTask();
        $task->setId($row['id']);
        $task->setEmail($row['email']);
        $task->setUserName($row['username']);
        $task->setText($row['text']);
        $task->setStatus($row['status']);
        $task->setEdited($row['edited']);
        return $task;
    }
}