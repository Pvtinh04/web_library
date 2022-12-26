<?php
    require '../models/admin.php';

    $pass=$login_id="";
    $passErr[]="";
    $i=1;

    error_reporting(0);
    for($i = 0; $i < 10000; $i++){
        if (isset($_POST["resetpw".$i])) {
            if (empty($_POST["newpass".$i])) {
                $passErr[$i]="Hãy nhập mật khẩu mới";
            } else {
                $pass=$_POST["newpass".$i];
                $login_id = $_POST["idadmin".$i];
                if(strlen($pass) < 6){
                    $passErr[$i] = "Hãy nhập mật khẩu có tối thiểu 6 ký tự";
                } else {

                    updatePassword($login_id, $pass);
                    header('Location: reset_password_form.php');
                }
            }   
        }   
    }
?>