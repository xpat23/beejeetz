<?php


namespace Model\Domain\Task;


class TaskValidator
{
    protected $errors = [];

    public function isValid(TaskAbstract $task): bool
    {
        $this->errors = [];
        if (empty($task->getUserName())) {
            $this->errors['username'][] = "Это обязательное поле";
        }

        if (empty($task->getEmail())) {
            $this->errors['email'][] = "Это обязательное поле";
        }
        if (!filter_var($task->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'][] = "Невалидный Email";
        }

        if (empty($task->getText())) {
            $this->errors['text'][] = "Это обязательное поле";
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}