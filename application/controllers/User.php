<?php

namespace application\controllers;

use application\core\Controller;

class User extends Controller
{
    public function signIn()
    {
        $this->view->render('Sign in');
    }

    public function login()
    {
        $admin = $this->model->getAdmin();

        if (!(strcmp($admin[0]['name'], $_POST['username']) === 0)
            || !(strcmp($admin[0]['password'], $_POST['password']) === 0)) {
            $json = json_encode(
                [
                    'success' => false,
                    'message' => 'В доступе отказано. Неверный логин или пароль.',
                ], JSON_UNESCAPED_UNICODE
            );

            echo $json;

            return false;
        }

        $_SESSION['is_admin'] = true;
        $json                 = json_encode(
            [
                'success' => true,
                'url'     => '/task/read',
            ], JSON_UNESCAPED_UNICODE
        );

        echo $json;
    }

    public function signOut()
    {
        $_SESSION['is_admin'] = false;

        return true;
    }
}