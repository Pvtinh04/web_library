<?php 
    require_once '../common/db.php';

    function checkLoginId($id){

        global $conn;

        $sqladmins = "SELECT * FROM `admins` WHERE login_id = '$id'";
        $listadmins =  $conn -> prepare($sqladmins);
        $listadmins -> execute();

        $result = $listadmins->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    function updateToken($id, $micro){
    
        global $conn;

        $sql = "UPDATE `admins` SET `reset_password_token`='$micro' WHERE login_id = '$id'";
        $listsql = $conn -> prepare($sql);
        $listsql -> execute();
        return $listsql;

    }
    
    function updatePassword($id, $newpass){
        
        global $conn;

        $sql = "UPDATE `admins` SET `password`= md5('$newpass'), `reset_password_token`='' WHERE login_id = '$id'";
        $listsql = $conn-> prepare($sql);
        $listsql -> execute();
    }

    function alladmins(){
        
        global $conn;
        
        $sqladmins = "SELECT * FROM `admins` WHERE reset_password_token <> ''";
        $listadmins =  $conn -> prepare($sqladmins);
        $listadmins -> execute();
        
        $result = $listadmins->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
  
    
?>
