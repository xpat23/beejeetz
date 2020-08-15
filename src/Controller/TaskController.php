<?php


namespace Controller;


use Core\BaseController;
use Core\Request;
use Model\Domain\Security\SecurityService;
use Model\Domain\Task\TaskAbstract;
use Model\Domain\Task\TaskRepositoryInterface;
use Model\Domain\Task\TaskValidator;

class TaskController extends BaseController
{
    const ITEMS_PER_PAGE = 3;

    public function listAction()
    {
        /** @var TaskRepositoryInterface $repository */
        $repository = $this->container->get(TaskRepositoryInterface::class);
        /** @var Request $request */
        $request = $this->container->get(Request::class);

        /** @var SecurityService $security */
        $security = $this->container->get(SecurityService::class);
        $notice = $request->getFlashMessage("notice");


        $page = $request->get("page", 1);
        $offset = $page * self::ITEMS_PER_PAGE - self::ITEMS_PER_PAGE;

        $tasks = $repository->findAll($offset, self::ITEMS_PER_PAGE,
            $request->get("order"),
            $request->get("direction")
        );

        $this->renderView("task/index", [
            'tasks' => $tasks,
            'request' => $request,
            "security" => $security,
            "pages" => range(1, ceil($repository->getTotalCount() / self::ITEMS_PER_PAGE)),
            "router" => $this->router,
            "notice" => $notice
        ]);
    }

    public function newAction()
    {
        /** @var Request $request */
        $request = $this->container->get(Request::class);
        $errors = [];
        /** @var TaskRepositoryInterface $repository */
        $repository = $this->container->get(TaskRepositoryInterface::class);
        $task = $repository->createTask();


        if ($request->methodIs(Request::METHOD_POST)) {
            $task->setUserName($request->getRequest("username"));
            $task->setEmail($request->getRequest("email"));
            $task->setText($request->getRequest("text"));
            /** @var TaskValidator $validator */
            $validator = $this->container->get(TaskValidator::class);
            if ($validator->isValid($task)) {
                $repository->save($task);
                 $request->addFlashMessage("notice","Задача успешно добавлена!");
                $this->redirectToRoute("index");
            } else {
                $errors = $validator->getErrors();
            }
        }

        $this->renderView("task/new", [
            "router" => $this->router,
            "errors" => $errors,
            "task" => $task
        ]);
    }

    public function editAction($id)
    {
        /** @var Request $request */
        $request = $this->container->get(Request::class);
        $errors = [];
        /** @var TaskRepositoryInterface $repository */
        $repository = $this->container->get(TaskRepositoryInterface::class);
        /** @var SecurityService $security */
        $security = $this->container->get(SecurityService::class);
        $task = $repository->find($id);
        $user = $security->getCurrentUser();

        if (!$task) {
            throw new \Exception("Task not found!");
        }

        if (!$user || !$user->isAdmin()) {
            throw new \Exception("Access denied!");
        }

        if ($request->methodIs(Request::METHOD_POST)) {

            $task->setStatus($request->getRequest("status") ? TaskAbstract::STATUS_DONE : TaskAbstract::STATUS_CREATED);
            if ($request->getRequest("text") != $task->getText()) {
                $task->setEdited(1);
            }
            $task->setText($request->getRequest("text"));
            $repository->save($task);
            $this->redirectToRoute("index");

        }

        $this->renderView("task/edit", [
            "router" => $this->router,
            "errors" => $errors,
            "task" => $task
        ]);
    }

}