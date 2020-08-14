<?php
/** @var \Core\Request $request */
$request = $args['request'];
/** @var \Core\RouterInterface $router */
$router = $args['router'];
/** @var \Model\Domain\Security\SecurityService $security */
$security = $args['security'];
/** @var \Model\Domain\Security\User $user */
$user = $security->getCurrentUser();
function getDirection($name, $request)
{
    return $request->get('order') == $name && $request->get('direction') == "asc" ? "desc" : "asc";
}

?>
<div style="padding: 25px;">
    <h4>Список задач</h4>
    <?php if ($user) : ?>
        <strong><?=$user->getUsername()?></strong>
        <a href="<?= $router->generate("user_logout") ?>" >Выйти</a>
    <?php else : ?>
        <a href="<?= $router->generate("user_login") ?>" >Войти</a>
    <?php endif ?>
    <hr>
    <a href="<?= $router->generate("task_new") ?>" class="btn btn-primary">Добавить</a>
    <br>
    <br>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th><a href="?page=1&order=email&direction=<?= getDirection("email", $request) ?>">Email</a></th>
            <th><a href="?page=1&order=username&direction=<?= getDirection("username", $request) ?>">Имя
                    пользователя</a></th>
            <th><a href="?page=1&order=status&direction=<?= getDirection("status", $request) ?>">Статус</a></th>
            <th>Изменен</th>
            <th>Текст</th>
            <?php if ($user && $user->isAdmin()) : ?>
                <th>Действия</th>
            <?php endif; ?>

        </tr>
        </thead>
        <tbody>
        <?php
        /**
         * @var $task \Model\Domain\Task\TaskAbstract
         */
        ?>
        <?php foreach ($args['tasks'] as $task) : ?>
            <tr>
                <td> <?= $task->getId() ?></td>
                <td><?= htmlspecialchars($task->getEmail(),ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($task->getUserName(),ENT_QUOTES) ?></td>
                <td><?= $task->getStatusString() ?></td>
                <td><?= $task->getEditedString() ?></td>
                <td><?= htmlspecialchars($task->getText(),ENT_QUOTES) ?></td>
                <?php if ($user && $user->isAdmin()) : ?>
                    <td>
                        <a href="<?=$router->generate("task_edit",["id" => $task->getId()]);?>" class="btn btn-info btn-sm">Редатировать</a>
                    </td>
                <?php endif;  ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php foreach ($args['pages'] as $page) : ?>
                <li class="page-item <?= $request->get("page", 1) == $page ? 'active' : '' ?>">
                    <a class="page-link"
                       href="?page=<?= $page ?>&order=<?= $request->get("order") ?>&direction=<?= $request->get("direction") ?>"><?= $page ?></a>
                </li>
            <?php endforeach; ?>

        </ul>
    </nav>


</div>