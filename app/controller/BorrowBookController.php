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
                    }
                    include_once "./app/view/" . $page . ".php";
                    break;
				
            }
        }
    }
    


?>