<?php
require_once "app/model/TransactionModel.php";
    class BorrowBookController extends Controller
    {
        
        private $model;
        public function __construct(){
            $this->model = new TransactionModel(); 
            $page = $_GET['page'];
            switch ($page) {
                case 'borrow_book_input':
                    $reg = "/^[0-9]{1,2}\\/[0-9]{1,2}\\/[0-9]{4}$/";
					$error = array(	"book"=>"",
									"user"=>"",
									"borrow_date"=>"",
									"give_date"=>"");
					$valid = true;
					$users = $this->model->getBookTransactionsUser();
					$books = $this->model->getBookTransactionsBook();
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["book"])) {
							$error["book"]="Hãy chọn sách.";
							$valid = false;
						} 
						if (empty($_POST["user"])) { 
							$error["user"] = "Hãy chọn người dùng.";
							$valid = false;
						} 
						if (empty($_POST["borrow_date"])) {
							$error["borrow_date"] = "Hãy nhập ngày mượn.";
							$valid = false;
						} 
						if (empty($_POST["give_date"])) {
							$error["give_date"]="Hãy nhập ngày trả.";
							$valid = false;
						}
						 if (!empty($_POST["borrow_date"]) AND !empty($_POST["give_date"])){
							if ($_POST["borrow_date"] > $_POST["give_date"]){
								$error["give_date"]="Hãy nhập ngày trả.";
								$error["borrow_date"] = "Hãy nhập ngày mượn.";
								$valid = false;
							}
						 }
						 if($valid){
							$_SESSION['borrow']['book']=$_POST['book'];
							$_SESSION['borrow']['user']=$_POST['user'];
							$_SESSION['borrow']['borrow_date']=$_POST['borrow_date'];
							$_SESSION['borrow']['give_date']=$_POST['give_date'];
							header('Location:index.php?page=borrow_book_confirm');
						 }
                    }
                    include_once "./app/view/" . $page . ".php";
                    break;
					case 'borrow_book_confirm':
						$users =  $this->model->getUserID($_SESSION['borrow']['user']);
						$books = $this->model->getBookID($_SESSION['borrow']['book']);
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							$book_id = $_SESSION['borrow']['book'];
							$user_id = $_SESSION['borrow']['user'];
							$borrown_date = date("Y-m-d", strtotime(implode("-", explode("/", $_SESSION['borrow']['borrow_date']))));
							$plan_date = date("Y-m-d", strtotime(implode("-", explode("/", $_SESSION['borrow']['give_date']))));
							 echo $update =date("Y-m-d h:i:s");
							$res =$this->model->addTransaction($book_id, $user_id,$borrown_date,$plan_date,$update);
							if($res){
								header("Location:index.php?page=borrow_book_complete");
							}
						}
						include_once "./app/view/" . $page . ".php";
						break;
					case 'borrow_book_complete':
						unset($_SESSION['borrow']);
						include_once "./app/view/" . $page . ".php";
						break;
				
            }
        }
    }
    


?>