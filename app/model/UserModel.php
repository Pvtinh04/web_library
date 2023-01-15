<?php
//  include_once('./model.php');
Class UserModel extends Model
{
    public function addUser($type,$name,$userid,$avatar,$description,$updated){
        $sql = "INSERT INTO `users` (`type`, `name`, `user_id`, `avatar`, `description`,`updated`,`created`) VALUES
            ('$type', '$name', '$userid', '$avatar', '$description','$updated','$updated')";
        return $this->pdo->query($sql);
    }
    public function updateAvatar($avatar,$cusID){
        $sql = "UPDATE `users` SET
            `avatar`='$avatar'
            WHERE `id` = $cusID";
            return $this->pdo->query($sql);
    }
    public function getUserId() {
        $sql = "SELECT `user_id`FROM `users` ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public function edit_user($id, $id_user, $name, $type, $avatar, $description)
        {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $time = date("Y-m-d h:i:s");
            
            $sql = "UPDATE `users` SET `user_id`='$id_user',`name`='$name',`type`='$type',`avatar`='$avatar',`description`='$description',`updated`='$time' WHERE `users`.id = '$id'";
            return $this->pdo->query($sql);
            
        }
    
        public function getUserById($id)
        {
            $sql = "SELECT * FROM `users` WHERE id = $id LIMIT 1";
            $result = $this->pdo->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
        
            return $row;
        }
    public function getAllUsers()
    {
        $query_user = "SELECT * FROM users";
        return $this->pdo->query($query_user)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchUser($type, $keyword)
    {
        if ($type && $keyword) {
            $query_user = "SELECT *  FROM users WHERE type = '$type' AND CONCAT(name, user_id, description) LIKE '%$keyword%' ORDER BY id DESC";
        } else if ($type) {
            $query_user = "SELECT *  FROM users WHERE type = '$type' ORDER BY id DESC";
        } else if ($keyword) {
            $query_user = "SELECT *  FROM users WHERE CONCAT(name, user_id, description) LIKE '%$keyword%' ORDER BY id DESC";
        } else {
            $query_user = "SELECT *  FROM users";
        };
        return $this->pdo->query($query_user)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listCategory()
    {
        $query_category = "SELECT category  FROM books GROUP BY category";
        return $this->pdo->query($query_category)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkBookInTransaction($id)
    {
        $query = "SELECT book_id  FROM book_transactions WHERE book_id = $id";
        $result = $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if (count($result[0]) > 0) {

        } else {
            return true;
        }
    }


    public function getUser($id)
    {
        $query = "SELECT *  FROM users WHERE id = $id";
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delUser($id)
    {
        $query = "DELETE  FROM users WHERE id = $id";
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>