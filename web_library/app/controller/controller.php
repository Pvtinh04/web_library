<?php
class Controller extends Model
{
	private $model;
	function __construct()
	{
		$this->model = new Model();
	}


	public function Controllers()
	{
		if (isset($_GET['page'])) {
			if ($_GET['page'] != 'resetpassword') {
				if (isset($_SESSION['authen'])) {
					$page = $_GET["page"];
				} else {
					$page = 'login';
				}
			} else {
				$page = 'resetpassword';
			}
		} elseif (isset($_SESSION['authen'])) {
			$page = 'home';
		} else {
			$page = 'login';
		}

		//Login validation
		switch ($page) {
			case "home":
				include_once "./app/view/" . $page . ".php";
				break;
			case 'login':
				date_default_timezone_set('Asia/Ho_Chi_Minh');
				$input_valid = true;
				$err_login = "";
				$error = array(
					"login_id" => "",
					"password" => ""
				);
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (empty($_POST["account"])) {
						$error["login_id"] = "Hãy nhập login id";
						$input_valid = false;
					} elseif (strlen($_POST["account"]) < 4) {
						$error["login_id"] = "Hãy nhập login tối thiểu 4 ký tự";
						$input_valid = false;
					}
					if (empty($_POST["password"])) {
						$error["password"] = "Hãy nhập password";
						$input_valid = false;
					} elseif (strlen($_POST["password"]) < 6) {
						$error["password"] = "Hãy nhập password tối thiểu 6 ký tự";
						$input_valid = false;
					}

					if ($input_valid) {
						if (isset($_POST['submit_login'])) {
							$idlogin = $_POST['account'];
							$pass = md5($_POST['password']);
							$admin = $this->model->login($idlogin, $pass);
							if (!empty($admin)) {
								foreach ($admin as $rowAdmin) {
									$_SESSION['authen'] = $rowAdmin;

									$_SESSION['timelogin'] = date("Y-m-d h:i:s");
									header('Location:index.php');
								}
							} else {
								$err_login = "Login ID và password không đúng";
							}
						}
					}
				}

				include_once "./" . $page . ".php";
				break;
			case "logout":
				unset($_SESSION['authen']);
				header('Location:index.php');
				break;
			case "resetpassword":


				include_once "./app/view/" . $page . ".php";
				break;
			case 'user_add_input':
				$reg = "/^[0-9]{1,2}\\/[0-9]{1,2}\\/[0-9]{4}$/";
				$error = array(
					"name" => "",
					"classify" => "",
					"id" => "",
					"avatar" => "",
					"description" => ""
				);
				$valid = true;
				$checkupload = true;
				$checkuserid = $this->model->getUserId();
				if ($_SERVER["REQUEST_METHOD"] == "POST") {

					if (empty($_POST["name"])) {
						$error["name"] = "Hãy nhập họ và tên";
						$valid = false;
					} elseif (strlen($_POST["name"]) > 100) {
						$error["name"] = "Không nhập quá 100 ký tự";
						$valid = false;
					}
					if (!isset($_POST["classify"])) {
						$error["classify"] = "Hãy chọn phân loại";
						$valid = false;
					}
					if (empty($_POST["id"])) {
						$error["id"] = "Hãy nhập ID";
						$valid = false;
					} elseif (preg_match('/[^A-Za-z0-9]/', $_POST["id"])) {
						$error["id"] = "Chỉ nhập không quá 10 ký tự chữ hoăc số tiếng Anh.";
						$valid = false;
					} elseif (strlen($_POST["id"]) > 10) {
						$error["id"] = "Chỉ nhập không quá 10 ký tự chữ hoăc số tiếng Anh.";
						$valid = false;
					} else {
						foreach ($checkuserid as $key => $value) {
							if ($_POST["id"] == $value['user_id']) {
								$error["id"] = "ID đã tồn tại vui lòng nhập lại.";
								$valid = false;
							}
						}
					}
					if (empty($_POST["description"])) {
						$error["description"] = "Hãy nhập mô tả chi tiết";
						$valid = false;
					} elseif (strlen($_POST["description"]) > 1000) {
						$error["description"] = "Không nhập quá 1000 ký tự";
						$valid = false;
					}
					if ($_FILES["avatar"]['error'] != 0) {
						$valid = false;
					}

					$target_dir_tmp    = "web/avatar/tmp/";
					$target_file   = $target_dir_tmp . basename($_FILES["avatar"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
					$checktypes    = array('jpg', 'png', 'jpeg', 'gif');
					$maxfilesize   = 800000;


					if (isset($_POST["submit"])) {
						$check = getimagesize($_FILES["avatar"]["tmp_name"]);
						if ($check !== false) {
							$valid = true;
						} else {
							$valid = false;
						}
					}

					if (file_exists($target_file)) {
						$error["avatar"] = "Hãy chọn avatar";
						$valid = false;
					} elseif (!in_array($imageFileType, $checktypes)) {
						$error["avatar"] = "Hình ảnh avatar phải là định dạng JPG, PNG, JPEG, GIF";
						$valid = false;
					}
					if ($_FILES["avatar"]["size"] > $maxfilesize) {
						$error["avatar"] = "Hình ảnh avatar không được lớn hơn $maxfilesize (bytes).";
						$valid = false;
					}
					if ($valid) {
						$_SESSION["user"]["name"] = $_POST["name"];
						$_SESSION["user"]["classify"] = $_POST["classify"];
						$_SESSION["user"]["id"] = $_POST["id"];
						$_SESSION["user"]["description"] = $_POST["description"];
						if (!file_exists($target_dir_tmp)) {
							mkdir($target_dir_tmp, 0777, true);
						} else {
							$files = glob($target_dir_tmp . '*');
							foreach ($files as $file) {
								if (is_file($file)) {
									unlink($file);
								}
							}
						}
						$target_file = $target_dir_tmp . pathinfo($_FILES['avatar']['name'], PATHINFO_FILENAME) . "_" . date('YmdHis') . "." . pathinfo($target_file, PATHINFO_EXTENSION);
						if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
							$_SESSION["user"]["avatar"] = $target_file;
						} else {
							$_SESSION["user"]["avatar"] = "Sorry, there was an error uploading your file.";
						}

						echo "<script>location.href = 'index.php?page=user_add_confirm';</script>";
						exit();
					}
				}
				include_once "./app/view/" . $page . ".php";
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

					$add_user = $this->model->addUser($type, $name, $userid, $avatar, $description, $updated);
					if ($add_user) {
						$cusID = $this->model->pdo->lastInsertId();
						$target_dir_id = "web/avatar/" . $cusID . "/";
						$target_file_id = str_replace("/" . "tmp/", "/" . "$cusID/", $_SESSION["user"]["avatar"]);
						if (!file_exists($target_dir_id)) {
							mkdir($target_dir_id, 0777, true);
						} else {
							$files = glob($target_dir_id . '*');
							foreach ($files as $file) {
								if (is_file($file)) {
									unlink($file);
								}
							}
						}
						if (rename($_SESSION["user"]["avatar"], $target_file_id)) {
							$avatar = $target_file_id;
						}
						unset($_SESSION["user"]); //delete Session variable

						$update_avatar = $this->model->updateAvatar($avatar, $cusID);
						if ($update_avatar) {
							echo "<script>location.href = 'index.php?page=user_add_complete';</script>";
						}
					}
				}
				include_once "./app/view/" . $page . ".php";
				break;
			case 'user_add_complete':
				include_once "./app/view/" . $page . ".php";
				break;
			case 'ledger_return_book':
				$_SESSION['bookId'] = '';
				$_SESSION['userId'] = '';
				$data = array();
				$books = array();
				$users = array();
				$result_book = $this->model->getAllBooks();
				// var_dump($result_book);
				foreach ($result_book as $key => $value) {
					$books[] = $value;
				}
				$result_user = $this->model->getAllUsers();
				foreach ($result_user as $key => $value) {
					$users[] = $value;
				}
				if (isset($_POST['btn-search--reset'])) {
					$_SESSION['bookId'] = '';
					$_SESSION['userId'] = '';
				}
				$result_data = $this->model->getAllLedgerReturnBooks();
				foreach ($result_data as $key => $value) {
					$data[] = $value;
				}
				if (isset($_GET['id'])) {
					$result = $this->model->updateReturnActualDate($_GET['id'] + 1);
					var_dump($_GET['id']);
					if ($result) {
						header('location:index.php?page=ledger_return_book');
					}
				}
				if (isset($_POST['btn-search--search'])) {
					$data_search = array();
					$bookId = isset($_POST['bookId']) ? $_POST['bookId'] : '';
					$userId = isset($_POST['userId']) ? $_POST['userId'] : '';
					$_SESSION['bookId'] = $bookId;
					$_SESSION['userId'] = $userId;
					$result_data = $this->model->searchLedgerReturnBook($bookId, $userId);
					foreach ($result_data as $key => $value) {
						$data_search[] = $value;
					}
					$data = $data_search;
				}
				include_once "./app/view/" . $page . ".php";
				break;
		}
	}
}
?>
