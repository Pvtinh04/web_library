<?php

class BookHistoryModel extends Model{

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
?>