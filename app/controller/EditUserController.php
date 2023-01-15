<?php
    class EditUserController extends Controller
    {
        private $model;
        public function __construct(){
            $this->model = new UserModel(); 
            $page = $_GET['page'];
            switch ($page) {
                case 'user_edit':
					$id=$_GET['id'];
                    $userInfo = $this->model->getUserById($id);
                    if (empty($userInfo)){
                        $userInfo = array("name"=>"", "user_id"=>"", "type"=>"","avatar"=>"","description"=>"");
                    }
                    $reg = "/^[0-9]{1,2}\\/[0-9]{1,2}\\/[0-9]{4}$/";
                    $error = array(
                        "name" => "",
                        "classify" => "",
                        "id" => "",
                        "avatar" => "",
                        "description" => ""
                    );
                    $checkupload = true;
                    $checkuserid = $this->model->getUserId();
                    $target_file = !empty($_SESSION["user_avatar"]) ? $_SESSION["user_avatar"] :$userInfo['avatar'];
                    if (isset($_POST['edit_user_submit'])) {
                        if (empty($_POST["name"])) {
                            $error["name"] = "Hãy nhập họ và tên";
                        } elseif (strlen($_POST["name"]) > 100) {
                            $error["name"] = "Không nhập quá 100 ký tự";
                        }
                        if (!isset($_POST["classify"])) {
                            $error["classify"] = "Hãy chọn phân loại";
                        }
                        if (empty($_POST["user_id"])) {
                            $error["id"] = "Hãy nhập ID";
                        } elseif (preg_match('/[^A-Za-z0-9]/', $_POST["user_id"])) {
                            $error["id"] = "Chỉ nhập không quá 10 ký tự chữ hoăc số tiếng Anh.";
                        } elseif (strlen($_POST["user_id"]) > 10) {
                            $error["id"] = "Chỉ nhập không quá 10 ký tự chữ hoăc số tiếng Anh.";
                        } else {
                            foreach ($checkuserid as $key => $value) {
                                if ($_POST["user_id"] == $value['user_id']) {
                                    $error["user_id"] = "ID đã tồn tại vui lòng nhập lại.";
                                    break;
                                }
                            }
                        }
                        if (empty($_POST["description"])) {
                            $error["description"] = "Hãy nhập mô tả chi tiết";
                        } elseif (strlen($_POST["description"]) > 1000) {
                            $error["description"] = "Không nhập quá 1000 ký tự";
                        }

                        // check IMAGE
                        if ( !empty($_FILES['user_avatar']["tmp_name"])){
                            $target_dir_tmp    = "web/avatar/tmp/";
                            $target_file   = $target_dir_tmp . basename($_FILES["user_avatar"]["name"]);
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            $checktypes    = array('jpg', 'png', 'jpeg', 'gif');
                            $maxfilesize   = 800000;
                            if (!file_exists($target_dir_tmp)) {
                                mkdir($target_dir_tmp, 0777);
                            }
                            if (!in_array($imageFileType, $checktypes)) {
                                $error["avatar"] = "Hình ảnh avatar phải là định dạng JPG, PNG, JPEG, GIF";
                            }
                            if ($_FILES["user_avatar"]["size"] > $maxfilesize) {
                                $error["avatar"] = "Hình ảnh avatar không được lớn hơn $maxfilesize (bytes).";
                            }

                            $target_file = $target_dir_tmp . pathinfo($_FILES['user_avatar']['name'], PATHINFO_FILENAME) . "_" . date('YmdHis') . "." . $imageFileType;
                            move_uploaded_file($_FILES["user_avatar"]["tmp_name"], $target_file);
                            
                        }

                        if (!empty($error)) {
                            $_SESSION["user_name"] = $_POST["name"];
                            $_SESSION["user_classify"] = $_POST["classify"];
                            $_SESSION["user_id"] = $_POST["user_id"];
                            $_SESSION["user_description"] = $_POST["description"];
                            $_SESSION['id'] = $id;
                            $_SESSION["user_avatar"] = $target_file;
                            
                            echo "<script>location.href = 'index.php?page=user_edit_confirm';</script>";
                            
                        }else{
                            include './app/view/user_edit.php';
                        }
                    }else{
                        include './app/view/user_edit.php';
                    }
					break;
				case 'user_edit_confirm':
					date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $id_user  = $_SESSION['user_id'];
                    $userInfo = $this->model->getUserById($id_user);
                    if (isset($_POST['submit_edit_complete'])) {
                        $name = $_SESSION['user_name'];
                        $type = $_SESSION['user_classify'];
                        $id_user  = $_SESSION['user_id'];
                        $description = $_SESSION['user_description'];
                        $avatar_old = !empty($_SESSION['user_avatar'])?$_SESSION['user_avatar']:$userInfo['avatar'];
                        $id = $_SESSION['id'];
                        $target_dir_id = "web/avatar/" . $id . "/";
                        if (!file_exists($target_dir_id)) {
                            mkdir($target_dir_id, 0777, true);
                        } else {
                            $files = glob($target_dir_id . '*');
                            foreach ($files as $file) {
                                    unlink($file);
                            }
                        }
                        $target_file_id = str_replace("tmp", "$id", $avatar_old);
                        $avatar = $target_file_id;
                        copy($avatar_old, $avatar);
                        $_SESSION['user_avatar'] = $target_file_id;
                        if ($this->model->edit_user($id, $id_user, $name, $type, $avatar, $description)) {
                            unlink($avatar_old);
                            unset($_SESSION['user_name']); //delete Session variable
                            unset($_SESSION['user_classify']); //delete Session variable
                            unset($_SESSION['user_id']); //delete Session variable
                            unset($_SESSION['user_description']); //delete Session variable
                            unset($_SESSION['user_avatar']); //delete Session variable
                            unset($_SESSION['id']); //delete Session variable

                            
                            echo "<script>location.href = 'index.php?page=user_edit_complete';</script>";
                        }else{
                            include_once "./app/view/user_edit_confirm.php";
                        }
                    }
                    else{
                        include_once "./app/view/user_edit_confirm.php";
                    }
					break;
				case 'user_edit_complete':
					include_once "./app/view/".$page.".php";
					break;
            }
        }
    }
    


?>