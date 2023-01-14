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
}

?>