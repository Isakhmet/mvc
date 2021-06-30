<?php

namespace application\controllers;

use \application\core\Controller;
use \application\library\DataBase;
use application\models\User;

class Task extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function read()
    {
        $page        = 1;
        $notesOnPage = 3;
        $order       = '';
        $sort        = 'ASC';

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        $offset     = ($page - 1) * $notesOnPage;
        $tasksCount = $this->model->getCount();
        $pageCount  = ceil($tasksCount[0]['count'] / $notesOnPage);
        $data       = [
            'limit'  => $notesOnPage,
            'offset' => $offset,
            'sort'   => $sort,
        ];

        if (isset($_GET['order'])) {
            $data['order'] = $_GET['order'];
            $data['sort']  = $_GET['sort'];
            $sort          = $_GET['sort'];
            $order         = "&&order={$data['order']}&&sort={$data['sort']}";
        }

        $params = [
            'tasks'     => $this->model->getTasks($data),
            'pageCount' => $pageCount,
            'page'      => $page,
            'order'     => $order,
            'sort'      => strcmp($sort, 'ASC') === 0 ? 'DESC' : 'ASC',
        ];

        $this->view->render('Task', $params);
    }

    public function create()
    {
        $params = [
            'name'        => strip_tags($_POST['user']),
            'email'       => strip_tags($_POST['email']),
            'title'       => strip_tags($_POST['title']),
            'description' => strip_tags($_POST['description']),
        ];

        $params['userId'] = (new User())->existUser($params);

        if (!$params['userId']) {
            $params['userId'] = (new User())->addUser($params);
        }

        $this->model->insertTask($params);
    }

    public function edit()
    {
        $taskId = $_GET['taskId'];
        $task   = $this->model->getTaskById($taskId);

        echo json_encode($task[0]);
    }

    public function update()
    {
        if(!$_SESSION['is_admin']) {
            echo 'false';
            return false;
        }

        $params = [
            'id'          => $_POST['id'],
            'description' => $_POST['description'],
            'status'      => $_POST['status'],
        ];

        $isChanged = $this->model->isChanged($params);

        if ($isChanged) {
            $params['is_changed'] = true;
        }

        $this->model->updateTask($params);
    }
}