<?php

namespace application\models;

use application\core\Model;

class Task extends Model
{
    public function getTasks()
    {
        $result = $this->db->row(
            'select t.title, t.description, t.status, u.name, u.email from tasks t left join users u on t.user_id = u.id'
        );

        return $result;
    }
}