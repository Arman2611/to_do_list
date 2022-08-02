<?php

namespace App\Controllers;

use App\Consts\TaskConsts;
use App\Consts\ViewConsts;
use App\Services\HTMLRenderingService;
use App\Services\Tasks\GetTasksService;
use App\Services\Tasks\CreateTaskService;

use App\Middlewares\InsertTableDataValidator;

class TaskController
{
    public function index (): void
    {
        $order_column = TaskConsts::TASKS_DEFAULT_ORDER_COLUMN;
        $order = TaskConsts::TASKS_DEFAULT_ORDER;
        $page = TaskConsts::TASKS_DEFAULT_PAGE;
        $chunk = TaskConsts::TASKS_SINGLE_PAGE_TASKS_COUNT;


        if (isset($_GET["order_column"]) and in_array($_GET["order_column"], TaskConsts::TASKS_TABLE_COLUMNS)) {
            $order_column = $_GET["order_column"];
            setcookie('order_column', $order_column, 0, "/");
        } else if (isset($_COOKIE["order_column"]) and in_array($_COOKIE["order_column"], TaskConsts::TASKS_TABLE_COLUMNS)) {
            $order_column = $_COOKIE["order_column"];
        }

        if (isset($_GET["order"]) and in_array($_GET["order"], TaskConsts::TASKS_ORDER_VARIANTS)) {
            $order = $_GET["order"];
            setcookie('order', $order, 0, "/");
        } else if (isset($_COOKIE["order"]) and in_array($_COOKIE["order"], TaskConsts::TASKS_ORDER_VARIANTS)) {
            $order = $_COOKIE["order"];
        }

        if (isset($_GET["page"]) and intval($_GET['page']) > 0) {
            $page = intval($_GET['page']);
        } else if (isset($_COOKIE["page"]) and intval($_COOKIE['page']) > 0) {
            $page = intval($_COOKIE['page']);
        }

        $_COOKIE['page'] = $page;
        setcookie('page', $page, 0, "/");


        $tasks = (new GetTasksService())->get($order_column, $order, $page, $chunk);

        if($tasks === []) {
            if ($page === 1) {
                $_COOKIE['message'] = TaskConsts::TASKS_EMPTY_MESSAGE;
                setcookie('message', TaskConsts::TASKS_EMPTY_MESSAGE, 0, "/");
            } else {
                $_COOKIE['message'] = TaskConsts::TASKS_PAGE_EMPTY_MESSAGE;
                setcookie('message', TaskConsts::TASKS_PAGE_EMPTY_MESSAGE, 0, "/");
            }
        }

        (new HTMLRenderingService())->render('App/Public/views/main.php', [
            'page-title' => ViewConsts::PAGE_TITLE,
            'tasks' => $tasks
        ]);
    }

    public function create (): void
    {
        (new HTMLRenderingService())->render('App/Public/views/newTaskForm.php', [
            'page-title' => ViewConsts::PAGE_TITLE
        ]);
    }

    public function store (): void
    {
        $data = [];

        if (isset($_POST['username'])) {
            $data['username'] = htmlspecialchars($_POST['username']);
        }
        if (isset($_POST['email'])) {
            $data['email'] = htmlspecialchars($_POST['email']);
        }
        if (isset($_POST['task'])) {
            $data['task'] = htmlspecialchars($_POST['task']);
        }
        $data['status'] = 'Не выполнен';

        $warnings = (new InsertTableDataValidator())->validate($data);

        if ($warnings === '') {
            try {
                (new CreateTaskService())->create($data);

                header("refresh: 0; url=/");
                setcookie('creation_message', TaskConsts::TASK_SUCCESS_MESSAGE, 0, "/");
            } catch(\PDOException $err) {

                header("refresh: 0; url=/task/create");
                setcookie('warning_message', TaskConsts::TASK_FAILED_MESSAGE, 0, "/");
            }
        } else {

            header("refresh: 0; url=/task/create");
            setcookie('warning_message', $warnings, 0, "/task");
        }

    }


    public function notFound (): void
    {
        (new HTMLRenderingService())->render('App/Public/views/404.php', [
            'page-title' => ViewConsts::PAGE_TITLE,
            'page-not-found-message' => ViewConsts::PAGE_NOT_FOUND_MESSAGE
        ]);
    }
}