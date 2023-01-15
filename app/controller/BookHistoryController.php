<?php
require_once "app/model/TransactionModel.php";
    class BookHistoryController extends Controller
    {
        
        private $model;
        public function __construct(){
            $this->model = new TransactionModel(); 
            $page = $_GET['page'];
            switch ($page) {
                
                case 'book_history':
                    $_SESSION['bookId'] = '';
                    $_SESSION['userId'] = '';
                    $data = array();
                    $books = $this->model->getAllBooks();
                    $users = $this->model->getAllUsers();
                   
                    $result_history = $this->model->getAllHistory();
                    foreach ($result_history as $key => $value) {
                        $data[] = $value;
                    }
                    if(isset($_POST["search--"])){
                        $data_search = array();
                        $bookId = $_POST["bookId"];
                        $userId = $_POST["userId"];
                        unset($result_history);
                        $result_history = $this->model->searchHistory($bookId, $userId);
                        foreach ($result_history as $key => $value) {
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