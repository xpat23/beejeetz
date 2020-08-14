<?php

namespace Model\Domain\Task;

abstract class TaskAbstract
{
    const STATUS_CREATED = 1; // создано
    const STATUS_DONE = 2; // выполнено
    /**
     * @var int|null
     */
    protected $id;
    /**
     * @var string|null
     */
    protected $userName;

    /**
     * @var string|null
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $text;

    /**
     * @var int|null
     */
    protected $status = self::STATUS_CREATED;

    /**
     * @var int
     */
    protected $edited = 0;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string|null $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getEdited(): int
    {
        return $this->edited;
    }

    public function getEditedString()
    {
        return $this->getEdited() ? "Отредактировано администратором" : "";
    }

    /**
     * @param int $edited
     */
    public function setEdited(int $edited): void
    {
        $this->edited = $edited;
    }

    public function getStatusString()
    {
        switch ($this->getStatus()) {
            case self::STATUS_CREATED :
                return "Добавлен";
            case self::STATUS_DONE :
                return "Выполнен";
        }
    }

}