<?php 
require_once "app/model/AdminModel.php";

    class ResetPasswordController extends Controller
    {
        private $model;
        public function __construct(){
            $this->model = new AdminModel();
            $page = $_GET['page'];
            switch ($page) {
                case 'reset_password':
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
                                $result = $this->model->checkLoginId($user);
                                $count = count($result);
                                
                                if($count == 0){
                                    $userErr = "Login id không tồn tại trong hệ thống";
                                } else {
                                    $micro = microtime(true);
                                    $update = $this->model->updateToken($user,$micro);
                                    header("Location: login.php");
                                }
                            }
                        }
                    }
                    include_once "./app/view/".$page.".php";
					break;
                case 'reset_password_form':
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
                    include_once "./app/view/".$page.".php";
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
    
?>