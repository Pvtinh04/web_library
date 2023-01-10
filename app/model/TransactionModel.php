<?php

class TransactionModel extends Connect
{
    public function getAllBooks()
    {
        $query = $this->pdo->prepare("SELECT * FROM books");
        $query->setFetchMode(PDO::FETCH_OBJ);
        $query->execute();
        $data = [];
        while ($row = $query->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAllUsers($column = "*")
    {
        $query = $this->pdo->prepare("SELECT id,name FROM users");
        $query->setFetchMode(PDO::FETCH_OBJ);
        $query->execute();
        $data = [];
        while ($row = $query->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAllTransactions()
    {
        $query = $this->pdo->prepare("select t.*,b.name as book_name, u.name as user_name from book_transactions as t
left join books as b on t.book_id = b.id
left join users as u on u.id = t.user_id");
        $query->setFetchMode(PDO::FETCH_OBJ);
        $query->execute();
        $data = [];
        while ($row = $query->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getAllTransactionByParam($param)
    {

        $condition = ["true"];
        if ($param['status'] && $param['status'] == 1) {
            $condition[] = "t.return_actual_date is null and DATE(NOW()) <= DATE(t.return_plan_date)";
        } else if ($param['status'] == 2) {
            $condition[] = "t.return_actual_date is null and DATE(NOW()) > DATE(t.return_plan_date)";
        } else if ($param['status'] == 3) {
            $condition[] = "t.return_actual_date is not null";
        }
        if (!is_null($param['book_id']) && strlen($param['book_id']) > 0) {
            $placeholder  = str_repeat ('?, ',  count (explode(",",$param["book_id"])) - 1) . '?';
            $condition[] = "t.book_id IN($placeholder)";
        }
        if (!is_null($param['user_id']) && strlen($param['user_id']) > 0) {
            $placeholder  = str_repeat ('?, ',  count (explode(",",$param["user_id"])) - 1) . '?';
            $condition[] = "t.user_id IN ($placeholder)";
        }
        $query = "select t.*,b.name as book_name, u.name as user_name from book_transactions as t
left join books as b on t.book_id = b.id
left join users as u on u.id = t.user_id where ";
        if (count($condition) > 0) {
            $raw = implode(" and ", $condition);
            $query = $query . $raw;
            $exec = $this->pdo->prepare($query);
            $exec->setFetchMode(PDO::FETCH_OBJ);
            $merge = [];

            if (!is_null($param['book_id']) && strlen($param['book_id']) > 0) {
               $merge =  array_merge($merge,explode(",",$param['book_id']));
            }
            if (!is_null($param['user_id']) && strlen($param["user_id"]) > 0) {
                $merge = array_merge($merge,explode(",",$param['user_id']));
            }

            $exec->execute($merge);
            $data = [];
            while ($row = $exec->fetch()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}