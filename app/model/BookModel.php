<?php

class BookModel extends Connect
{
		function deBook(){
			$sql1 = 'SELECT * FROM `books`';
			$listTeacher = $this->pdo->query($sql1);
			$listTeacher->execute();
			return $listTeacher;
			}
    function get_room($id){ 
        if($id !=NULL){
            $sql = "SELECT * FROM `books` WHERE id=$id ";
            $getData = $this->pdo -> prepare($sql);
            $getData->execute();
            $getData->setFetchMode(PDO::FETCH_ASSOC); 
            $resultUser = $getData->fetchAll();
           return $resultUser;
        };
    }
		function editBook($id,$name,$category,$author,$quantity,$avatar,$description,$update){
			 
        if($id !=NULL){
            $sql = "UPDATE `books` SET `name`='$name',`category`='$category',`author`='$author',`quantity`='$quantity',`avatar`='$avatar',`description`='$description',`updated`='$update',`created`='' WHERE id=$id";            
						$update = $this->pdo -> prepare($sql);
            $update->execute();
        };
		}
    function getLastIDR(){
        $idT=0;
        $query = $this->pdo ->prepare("SELECT * FROM `books` WHERE id=(SELECT max(id) FROM `books`)");
        $query -> execute();
        foreach ($query as $id) {
           $idT= $id['id'];
        }
        return $idT+1;
    }

    function history_transaction($user_id, $book_id)
{
       
        $querys = '';
        if ($book_id == '' && $user_id == '') {
            $querys = "SELECT  users.id as users_id,
                        users.name as users_name, 
                        book_transactions.brrowed_date as borrowed_date,
                        book_transactions.return_plan_date as return_plan_date,
                        book_transactions.return_actual_date as return_actual_date,
                        books.name as books_name 
                        FROM `book_transactions`,`users`,`books` 
                        WHERE users.id = book_transactions.user_id AND book_transactions.book_id = books.id";
        } else if ($book_id == '') {
            $querys = "SELECT users.id as users_id, 
                                                users.name as users_name, 
                                                book_transactions.brrowed_date as borrowed_date,
                                                book_transactions.return_plan_date as return_plan_date,
                                                book_transactions.return_actual_date as return_actual_date,
                                                books.name as books_name 
                                FROM `book_transactions`,`users`,`books` 
                                WHERE users.id LIKE '%" . $user_id . "%' AND users.id = book_transactions.user_id AND book_transactions.book_id = books.id";
        } else if ($user_id == '') {
            $querys = "SELECT users.id as users_id, 
                                                users.name as users_name, 
                                                book_transactions.brrowed_date as borrowed_date,
                                                book_transactions.return_plan_date as return_plan_date,
                                                book_transactions.return_actual_date as return_actual_date,
                                                books.name as books_name 
                                FROM `book_transactions`,`users`,`books`  
                        WHERE book_id =" . $book_id . " AND users.id = book_transactions.user_id AND book_transactions.book_id = books.id";
        } else {
                $querys = "SELECT  users.id as users_id,
                users.name as users_name, 
                book_transactions.brrowed_date as borrowed_date,
                book_transactions.return_plan_date as return_plan_date,
                book_transactions.return_actual_date as return_actual_date,
                books.name as books_name 
                FROM `book_transactions`,`users`,`books` 
                WHERE book_id =".$book_id." AND users.id LIKE '%".$user_id."%' AND users.id = book_transactions.user_id AND book_transactions.book_id = books.id";
        }
        $sql = $this->pdo->prepare($querys);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
}
public function getAllBooks()
	{
		$query_books = "SELECT * FROM books";
		return $this->pdo->query($query_books)->fetchAll(PDO::FETCH_ASSOC);
	}
    public function searchBook($cate, $keyword)
	{
		if ($cate && $keyword) {
			$query_book = "SELECT *  FROM books WHERE category = '$cate' AND CONCAT(name, category, author, description) LIKE '%$keyword%' ORDER BY id DESC";
		} else if ($cate) {
			$query_book = "SELECT *  FROM books WHERE category = '$cate' ORDER BY id DESC";
		} else if ($keyword) {
			$query_book = "SELECT *  FROM books WHERE CONCAT(name, category, author, description) LIKE '%$keyword%' ORDER BY id DESC";
		} else {
			return [];
		};
		return $this->pdo->query($query_book)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function listCategory()
	{
		$query_category = "SELECT category  FROM books GROUP BY category";
		return $this->pdo->query($query_category)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function checkBookInTransaction($id)
	{
		$query = "SELECT * FROM book_transactions WHERE book_id = $id AND return_actual_date = '0000-00-00'";
		$result = $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
		if (count($result) > 0) {
            return true;
        } else {
            return false;
		}
	}


	public function getBook($id)
	{
		$query = "SELECT *  FROM books WHERE id = $id";
		return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	}

    public function deleteBook($id){
        $query = "DELETE FROM books WHERE id = $id";
        $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        $query = "DELETE FROM book_transactions WHERE book_id = $id"; //delete book transactions when delete book ???
        $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

    }
}