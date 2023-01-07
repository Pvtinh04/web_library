<?php

$conn = new mysqli($host, $user, $pass, $dbname);
echo $conn;
// include_once "../common/db.php";

class Transaction extends Model
{

    function __construct()
    {
        parent::__construct();
    }


    function getAllHistory()
    {
        // $query_history = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS userid, users.name AS username FROM book_transactions 
		// 	JOIN books ON book_transactions.book_id = books.id 
		// 					JOIN users ON book_transactions.user_id = users.id 
		// 					ORDER BY book_transactions.id ASC";
        // return $this->pdo->query($query_history)->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchHistory($bookId, $userId)
    {
        // $query_history = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS userid, users.name AS username FROM book_transactions 
        // JOIN books ON book_transactions.book_id = books.id 
        // 				JOIN users ON book_transactions.user_id = users.id 
        // 				WHERE books.id = '$bookId' AND users.id = '$userId' ORDER BY book_transactions.id ASC";
        // return $this->pdo->query($query_history)->fetchAll(PDO::FETCH_ASSOC);
     
    }
}
