<?php 
	class Model extends Connect
	{
		
		function __construct()
		{
			parent::__construct(); 
		}  
		
		
		public function login($idlogin,$pass)
			{
				$sql = "SELECT * FROM `admins` WHERE Login_id = :login_id AND Password = :passw AND actived_flag > 0";
				$pre = $this->pdo->prepare($sql);
				$pre->bindParam(':login_id', $idlogin);
				$pre->bindParam(':passw', $pass);
				$pre->execute();
				return $pre->fetchAll(PDO::FETCH_ASSOC);
			}
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
 