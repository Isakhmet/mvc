<?php

namespace application\models;

use application\core\Model;

class User extends Model
{
    public function existUser($data)
    {
        $params = [
            'name' => $data['name'],
        ];

        return $this->db->column('select id from users where name = :name', $params);
    }

    public function addUser($data)
    {
        $params = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        $this->db->query('insert into users(name, email) values(:name, :email)', $params);
        return (int)$this->db->getLastInsertId();
    }

    public function getAdmin()
    {
        return $this->db->row('select name, password from users where role = :admin', ['admin' => 'admin']);
    }
}