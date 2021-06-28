<?php

namespace application\models;

use application\core\Model;

class Task extends Model
{
    public function getTasks($data)
    {
        $orderBy = '';

        if (isset($data['order'])) {
            $orderBy = " ORDER BY {$data['order']} {$data['sort']}";
        }

        $result = $this->db->row(
            "select t.id, t.title, t.description, t.status, t.is_changed, u.name, u.email 
                    from tasks t 
                    left join users u 
                        on t.user_id = u.id
                        $orderBy
                        LIMIT {$data['limit']} 
                        OFFSET {$data['offset']}
                        "
        );

        return $result;
    }

    public function getCount()
    {
        return $this->db->row('SELECT count(*) from tasks');
    }

    public function insertTask($data)
    {
        $params = [
            'title'       => $data['title'],
            'userId'      => $data['userId'],
            'description' => $data['description'],
        ];

        $this->db->query(
            'insert into tasks(title, description, user_id) values(:title, :description, :userId)', $params
        );
    }

    public function updateTask($data)
    {
        $set = '';

        if(isset($data['is_changed'])) {
            $set = ', is_changed = :is_changed';
        }

        $this->db->query(
            "update tasks set description = :description, status = :status $set where id=:id", $data
        );
    }

    public function getTaskById($id)
    {
        return $this->db->row('select t.title, t.description, t.status, u.name, u.email 
                    from tasks t  
                    left join users u 
                        on t.user_id = u.id  where t.id = :id', ['id' => $id]);
    }

    public function isChanged($data)
    {
        $params = [
            'id' => $data['id']
        ];

        $description = $this->db->column('select description from tasks where id = :id', $params);

        return !(strcmp($description, $data['description']) === 0);
    }
}