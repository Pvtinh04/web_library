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
}

?>