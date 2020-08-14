<?php
$errors = $args['errors'];
/** @var \Model\Domain\Task\TaskAbstract $task */
$task = $args['task'];
function validationErrors($field, $errors)
{
    $result = "";
    if (isset($errors[$field])) {
        foreach ($errors[$field] as $message) {
            $result .= "<div class=\"invalid-feedback\">$message</div>";
        }
    }
    return $result;
}

function fieldIsValid($field, $errors)
{
    return isset($errors[$field]) ? 'is-invalid' : '';
}

;
?>
<div style="padding: 25px;">
    <h4>Добавление задачи</h4>
    <hr>
    <form method="post">
        <div class="form-group">
            <label class="control-label  required">
                Имя пользователя
            </label>
            <input type="text" value="<?=$task->getUserName(); ?>" required class="form-control <?= fieldIsValid("username", $errors); ?>" name="username"/>
            <?= validationErrors("username", $errors) ?>
        </div>
        <div class="form-group">
            <label class="control-label  required">
                Email
            </label>
            <input type="text" value="<?=$task->getEmail(); ?>" required class="form-control <?= fieldIsValid("email", $errors); ?>"
                   name="email"/>
            <?= validationErrors("email", $errors) ?>
        </div>
        <div class="form-group">
            <label class="control-label  required">
                Текст задачи
            </label>
            <textarea name="text" class="form-control <?= fieldIsValid("text", $errors); ?>" required><?=$task->getText(); ?></textarea>
            <?= validationErrors("text", $errors) ?>
        </div>
        <br>
        <br>
        <input type="submit" value="Сохранить" class="btn btn-primary">
        <a href="<?= $args['router']->generate("index"); ?>" class="btn btn-secondary">Отмена</a>
    </form>

</div>
