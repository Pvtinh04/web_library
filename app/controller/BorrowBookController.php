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
							header('Location:index.php?$page=borrow_book_confirm');
						 }
                    }
                    include_once "./app/view/" . $page . ".php";
                    break;
					case 'borrow_book_confirm':
						
						include_once "./app/view/" . $page . ".php";
						break;
				
            }
        }
    }
    


?>