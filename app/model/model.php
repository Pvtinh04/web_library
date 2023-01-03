<?php
class Model extends Connect
{

	function __construct()
	{
		parent::__construct();
	}


	public function login($idlogin, $pass)
	{
		$sql = "SELECT * FROM `admins` WHERE Login_id = :login_id AND Password = :passw AND actived_flag > 0";
		$pre = $this->pdo->prepare($sql);
		$pre->bindParam(':login_id', $idlogin);
		$pre->bindParam(':passw', $pass);
		$pre->execute();
		return $pre->fetchAll(PDO::FETCH_ASSOC);
	}
	public function addUser($type, $name, $userid, $avatar, $description, $updated)
	{
		$sql = "INSERT INTO `users` (`type`, `name`, `user_id`, `avatar`, `description`,`updated`,`created`) VALUES
				('$type', '$name', '$userid', '$avatar', '$description','$updated','$updated')";
		return $this->pdo->query($sql);
	}
	public function updateAvatar($avatar, $cusID)
	{
		$sql = "UPDATE `users` SET
				`avatar`='$avatar'
				WHERE `id` = $cusID";
		return $this->pdo->query($sql);
	}
	public function getUserId()
	{
		$sql = "SELECT `user_id`FROM `users` ";
		return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllLedgerReturnBooks()
	{
		$query = "SELECT book_transactions.id AS id, book_transactions.return_plan_date AS return_plan_date, book_transactions.return_actual_date AS return_actual_date, books.id AS books_id, books.name AS books_name, users.id AS users_id, users.name AS users_name FROM book_transactions JOIN books ON book_transactions.book_id = books.id JOIN users ON book_transactions.user_id = users.id ORDER BY book_transactions.id ASC";
		return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllBooks()
	{
		$query_books = "SELECT books.id, books.name FROM books";
		return $this->pdo->query($query_books)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllUsers()
	{
		$query_users = "SELECT users.id, users.name FROM users";
		return $this->pdo->query($query_users)->fetchAll(PDO::FETCH_ASSOC);
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
}
?>
