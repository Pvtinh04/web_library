<?php 
	class AdminModel extends Connect
	{
		public function login($idlogin,$pass)
			{
				$sql = "SELECT * FROM `admins` WHERE Login_id = :login_id AND Password = :passw AND actived_flag > 0";
				$pre = $this->pdo->prepare($sql);
				$pre->bindParam(':login_id', $idlogin);
				$pre->bindParam(':passw', $pass);
				$pre->execute();
				return $pre->fetchAll(PDO::FETCH_ASSOC);
			}
            function checkLoginId($id){

            
        
                $sqladmins = "SELECT * FROM `admins` WHERE login_id = '$id'";
                $listadmins =  $this->pdo -> prepare($sqladmins);
                $listadmins -> execute();
                $result = $listadmins->fetchAll(PDO::FETCH_OBJ);
                return $result;
            }
		
                function updateToken($id, $micro){

                $sql = "UPDATE `admins` SET `reset_password_token`='$micro' WHERE login_id = '$id'";
                $listsql = $this->pdo -> prepare($sql);
                $listsql -> execute();
                return $listsql;

            }
            
            function updatePassword($id, $newpass){


                $sql = "UPDATE `admins` SET `password`= md5('$newpass'), `reset_password_token`='' WHERE login_id = '$id'";
                $listsql = $this->pdo-> prepare($sql);
                $listsql -> execute();
            }

            function alladmins(){

                
                $sqladmins = "SELECT * FROM `admins` WHERE reset_password_token <>''";
                $listadmins =  $this->pdo -> prepare($sqladmins);
                $listadmins -> execute();
                
                $result = $listadmins->fetchAll(PDO::FETCH_OBJ);

                return $result;
            }
		
	
	}
?>
 