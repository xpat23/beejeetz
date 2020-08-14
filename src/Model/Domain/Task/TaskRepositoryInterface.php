<?php

namespace Model\Domain\Task;


interface TaskRepositoryInterface
{

    public function createTask(): TaskAbstract;

    public function save(TaskAbstract $task);

    public function findAll(int $offset = 0, int $limit = 3, $order = "id", $direction = "desc");

    public function getTotalCount(): int;

    public function find($id): ?TaskAbstract;
}