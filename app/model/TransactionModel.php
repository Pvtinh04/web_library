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
    public function getAllLedgerReturnBooks()
	{
		$query = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS users_name FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id ORDER BY book_transactions.id ASC";
		return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	}
    public function updateReturnActualDate($id)
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$time = date('Y-m-d');
		$query = "UPDATE book_transactions SET return_actual_date = '" . $time . "' WHERE id = '" . $id . "'";
		return $this->pdo->query($query);
	}
    public function searchLedgerReturnBook($bookId, $userId)
	{
		$query = '';
		if ($bookId && $userId) {
			$query = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS users_name FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id WHERE books.id = '$bookId' AND users.id = '$userId' ORDER BY book_transactions.id ASC";
		} else if ($bookId) {
			$query = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS users_name FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id WHERE books.id = '$bookId' ORDER BY book_transactions.id ASC";
		} else if ($userId) {
			$query = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS users_name FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id WHERE users.id = '$userId' ORDER BY book_transactions.id ASC";
		} else {
			$query = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS users_name FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id ORDER BY book_transactions.id ASC";
		}
		return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	}
    function getHitory(){
        $sql="SELECT  book_transactions.created,users.name  FROM book_transactions join users on book_transactions.user_id=users.id";
        $pre = $this->pdo->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_ASSOC);
    }
    function searchHistory($userName,$bookName){
        $sql="SELECT * from book_transactions join books on book_transactions.book_id=books.id and books.name='{$bookName}' join users ON users.user_id=book_transactions.user_id and users.name='{$userName}'";
    }
}