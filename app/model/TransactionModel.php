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
left join users as u on u.id = t.user_id order by t.id desc");
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
            $query = $query . $raw. "  order by t.id desc";
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
    // function getHitory(){
    //     $sql="SELECT  book_transactions.created,users.name  FROM book_transactions join users on book_transactions.user_id=users.id";
    //     $pre = $this->pdo->prepare($sql);
    //     $pre->execute();
    //     return $pre->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getAllHistory()
		{
			$query_history = "SELECT 	book_transactions.id AS id,
										COUNT(book_transactions.book_id) as times,
										GROUP_CONCAT(book_transactions.borrowed_date SEPARATOR ',') AS borrowed_date,
										GROUP_CONCAT(book_transactions.return_plan_date SEPARATOR ',') AS return_plan_date,
										GROUP_CONCAT(book_transactions.return_actual_date SEPARATOR ',') AS return_actual_date, 
										books.id AS books_id,
										books.name AS books_name, 
										GROUP_CONCAT(users.id SEPARATOR ',') AS userid, 
										GROUP_CONCAT(users.name SEPARATOR ',') AS username FROM book_transactions 
								JOIN books ON book_transactions.book_id = books.id 
								JOIN users ON book_transactions.user_id = users.id 
								GROUP BY book_transactions.book_id
								ORDER BY book_transactions.id ASC";
			return $this->pdo->query($query_history)->fetchAll(PDO::FETCH_ASSOC);
		}

	public function searchHistory($bookId, $userId)
		{
			// $query_history = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS userid, users.name AS username FROM book_transactions
			// JOIN books ON book_transactions.book_id = books.id
			// 				JOIN users ON book_transactions.user_id = users.id
			// 				WHERE books.id = '$bookId' AND users.id = '$userId' ORDER BY book_transactions.id ASC";
			// return $this->pdo->query($query_history)->fetchAll(PDO::FETCH_ASSOC);
			$query_history = '';
			if ($bookId && $userId) {
				$query_history = "SELECT 	book_transactions.id AS id,
				COUNT(book_transactions.book_id) as times,
				GROUP_CONCAT(book_transactions.borrowed_date SEPARATOR ',') AS borrowed_date,
				GROUP_CONCAT(book_transactions.return_plan_date SEPARATOR ',') AS return_plan_date,
				GROUP_CONCAT(book_transactions.return_actual_date SEPARATOR ',') AS return_actual_date, 
				books.id AS books_id,
				books.name AS books_name, 
				GROUP_CONCAT(users.id SEPARATOR ',') AS userid, 
				GROUP_CONCAT(users.name SEPARATOR ',') AS username FROM book_transactions 
		JOIN books ON book_transactions.book_id = books.id 
		JOIN users ON book_transactions.user_id = users.id  And books.id = '$bookId' AND users.id = '$userId' ORDER BY book_transactions.id ASC";
			} else if ($bookId) {
				$query_history = "SELECT 	book_transactions.id AS id,
				COUNT(book_transactions.book_id) as times,
				GROUP_CONCAT(book_transactions.borrowed_date SEPARATOR ',') AS borrowed_date,
				GROUP_CONCAT(book_transactions.return_plan_date SEPARATOR ',') AS return_plan_date,
				GROUP_CONCAT(book_transactions.return_actual_date SEPARATOR ',') AS return_actual_date, 
				books.id AS books_id,
				books.name AS books_name, 
				GROUP_CONCAT(users.id SEPARATOR ',') AS userid, 
				GROUP_CONCAT(users.name SEPARATOR ',') AS username FROM book_transactions 
		JOIN books ON book_transactions.book_id = books.id 
		JOIN users ON book_transactions.user_id = users.id  And books.id = '$bookId' ORDER BY book_transactions.id ASC";
			} else {
				$query_history = "SELECT 	book_transactions.id AS id,
				COUNT(book_transactions.book_id) as times,
				GROUP_CONCAT(book_transactions.borrowed_date SEPARATOR ',') AS borrowed_date,
				GROUP_CONCAT(book_transactions.return_plan_date SEPARATOR ',') AS return_plan_date,
				GROUP_CONCAT(book_transactions.return_actual_date SEPARATOR ',') AS return_actual_date, 
				books.id AS books_id,
				books.name AS books_name, 
				GROUP_CONCAT(users.id SEPARATOR ',') AS userid, 
				GROUP_CONCAT(users.name SEPARATOR ',') AS username FROM book_transactions 
		JOIN books ON book_transactions.book_id = books.id 
		JOIN users ON book_transactions.user_id = users.id  And users.id = '$userId' ORDER BY book_transactions.id ASC";
			}
			// else {
			// 	$query_history = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS username FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id ORDER BY book_transactions.id ASC";
			// }
			return $this->pdo->query($query_history)->fetchAll(PDO::FETCH_ASSOC);
		}
}