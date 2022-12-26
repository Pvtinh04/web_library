<?php
    require '../models/admin.php';

    $user="";
    $userErr="";
    $micro="";
    // error_reporting(0);
    if(isset($_POST['reset-password'])) {

        if(empty($_POST["reset-input"])){
            $userErr="Hãy nhập login id";
        } else {
            $user = $_POST["reset-input"];
            if(strlen($user) < 4){
                $userErr="Hãy nhập login id tối thiểu 4 kí tự";
            } else {
                $result = checkLoginId($user);
                $count = count($result);
                
                if($count == 0){
                    $userErr = "Login id không tồn tại trong hệ thống";
                } else {
                    $micro = microtime(true);
                    $update = updateToken($user,$micro);
                    header("Location: login.php");
                }
            }
        }
    }
?>
