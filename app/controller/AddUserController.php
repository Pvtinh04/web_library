<?php
    class AddUserController extends Controller
    {
        private $model;
        public function __construct(){
            $this->model = new UserModel(); 
            $page = $_GET['page'];
            switch ($page) {
                case 'user_add_input':
					$reg = "/^[0-9]{1,2}\\/[0-9]{1,2}\\/[0-9]{4}$/";
					$error = array(	"name"=>"",
									"classify"=>"",
									"id"=>"",
									"avatar"=>"",
									"description"=>"");
					$valid = true;
					$checkupload = true;
					$checkuserid = $this->model->getUserId();
					if ($_SERVER["REQUEST_METHOD"] == "POST") {

						if (empty($_POST["name"])) {
							$error["name"]="Hãy nhập họ và tên";
							$valid = false;
						} elseif (strlen($_POST["name"])>100) {
							$error["name"]="Không nhập quá 100 ký tự";
							$valid = false;
						}
						if (!isset($_POST["classify"])) { 
							$error["classify"] = "Hãy chọn phân loại";
							$valid = false;
						} 
						if (empty($_POST["id"])) {
							$error["id"] = "Hãy nhập ID";
							$valid = false;
						} elseif (preg_match('/[^A-Za-z0-9]/', $_POST["id"])){
							$error["id"] = "Chỉ nhập không quá 10 ký tự chữ hoăc số tiếng Anh.";
							$valid = false;
						} elseif (strlen($_POST["id"]) > 10){
							$error["id"] = "Chỉ nhập không quá 10 ký tự chữ hoăc số tiếng Anh.";
							$valid = false;
						} else {
							foreach($checkuserid as $key =>$value){
								if ($_POST["id"]== $value['user_id']){
									$error["id"] = "ID đã tồn tại vui lòng nhập lại.";
									$valid = false;
								}
							}
						}
						if (empty($_POST["description"])) {
							$error["description"]="Hãy nhập mô tả chi tiết";
							$valid = false;
						} elseif (strlen($_POST["description"])>1000) {
							$error["description"]="Không nhập quá 1000 ký tự";
							$valid = false;
						}
						if ($_FILES["avatar"]['error'] != 0)
					{
						$valid = false;
					}

					$target_dir_tmp    = "web/avatar/tmp/";
					$target_file   = $target_dir_tmp . basename($_FILES["avatar"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$checktypes    = array('jpg', 'png', 'jpeg', 'gif');
					$maxfilesize   = 800000;


				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["avatar"]["tmp_name"]);
					if($check !== false)
					{
						$valid = true;
					}
					else
					{
						$valid = false;
					}
				}
				
					if (file_exists($target_file))
					{
						$error["avatar"]="Hãy chọn avatar";
						$valid = false;
					} elseif (!in_array($imageFileType,$checktypes))
					{
						$error["avatar"]="Hình ảnh avatar phải là định dạng JPG, PNG, JPEG, GIF";
						$valid = false;
					}
					if ($_FILES["avatar"]["size"] > $maxfilesize)
					{
						$error["avatar"]= "Hình ảnh avatar không được lớn hơn $maxfilesize (bytes).";
						$valid = false;
					}
					if ($valid) {
						$_SESSION["user"]["name"] = $_POST["name"];
						$_SESSION["user"]["classify"] = $_POST["classify"];
						$_SESSION["user"]["id"] = $_POST["id"];
						$_SESSION["user"]["description"] = $_POST["description"];
						if (!file_exists($target_dir_tmp)){
							mkdir($target_dir_tmp , 0777, true);
						} else {
							$files = glob($target_dir_tmp.'*'); 
							foreach($files as $file){ 
								if(is_file($file)) {
									unlink($file);
								} 
							}
						}
						$target_file = $target_dir_tmp . pathinfo($_FILES['avatar']['name'], PATHINFO_FILENAME)."_".date('YmdHis').".".pathinfo($target_file,PATHINFO_EXTENSION);
						if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
							$_SESSION["user"]["avatar"] =$target_file;
						} else {
							$_SESSION["user"]["avatar"] = "Sorry, there was an error uploading your file.";
						}
						
						echo "<script>location.href = 'index.php?page=user_add_confirm';</script>";
						exit();
						}  
					}
					include_once "./app/view/".$page.".php";
					break;
				case 'user_add_confirm':
					date_default_timezone_set("Asia/Ho_Chi_Minh");
					if (isset($_POST['submit_add_complete'])) {
						$name = $_SESSION["user"]['name'];
						$type = $_SESSION["user"]['classify'];
						$userid  = $_SESSION["user"]['id'];
						$description = $_SESSION["user"]['description'];
						$avatar = $_SESSION["user"]['avatar'];
						$updated = date("Y-m-d h:i:s");
						
						$add_user = $this->model->addUser($type,$name,$userid,$avatar,$description,$updated);
						if ($add_user) {
							$cusID = $this->model->pdo->lastInsertId();
							$target_dir_id = "web/avatar/".$cusID."/";
							$target_file_id = str_replace("/"."tmp/","/"."$cusID/",$_SESSION["user"]["avatar"]);
							if (!file_exists($target_dir_id)){
								mkdir($target_dir_id , 0777, true);
							} else {
								$files = glob($target_dir_id.'*');  
								foreach($files as $file){ 
									if(is_file($file)) {
										unlink($file);
									}
								}
							}
							if (rename($_SESSION["user"]["avatar"], $target_file_id)) {
								$avatar =$target_file_id;
							}
							unset($_SESSION["user"]);//delete Session variable

							$update_avatar = $this->model->updateAvatar($avatar,$cusID);
							if($update_avatar){
								echo "<script>location.href = 'index.php?page=user_add_complete';</script>";

							} 
						}


						
					}
					include_once "./app/view/".$page.".php";
					break;
				case 'user_add_complete':
					include_once "./app/view/".$page.".php";
					break;
            }
        }
    }
    


?>