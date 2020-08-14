<?php
/** @var \Model\Domain\Task\TaskAbstract $task */
$task = $args['task'];
?>
<div style="padding: 25px;">
    <h4>Изменение задачи</h4>
    <hr>
    <form method="post">

        <div class="form-group">
            <label class="control-label  required">
                Текст задачи
            </label>
            <textarea name="text" class="form-control" required><?= htmlspecialchars($task->getText(),
                    ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="status" value="1" <?php if($task->getStatus() == \Model\Domain\Task\TaskAbstract::STATUS_DONE) : ?> checked <?php endif;?>>
                Выполнен
            </label>
        </div>
        <br>
        <br>
        <input type="submit" value="Сохранить" class="btn btn-primary">
        <a href="<?= $args['router']->generate("index"); ?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>