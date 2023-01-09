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

    public function getAllUsers($column = "*") {
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
}