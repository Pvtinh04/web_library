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
                    $result = $this->model->alladmins();
                    error_reporting(0);
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                       $login_id = $_POST['reset_passowrd'];
                       print_r($_POST);
                       
                       if (empty($_POST["newpass".$login_id])) {
                        $passErr[$login_id]="Hãy nhập mật khẩu mới";
                       } else {
                            if (strlen($_POST["newpass".$login_id]) < 6){
                            $passErr[$login_id]= "Hãy nhập mật khẩu có tối thiểu 6 ký tự";
                           } else {
                            $pass = $_POST["newpass".$login_id];
                            $this->model->updatePassword($login_id, $pass);
                            header('Location: index.php?page=reset_password_form');
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