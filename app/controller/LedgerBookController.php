<?php
require_once "app/model/TransactionModel.php";
    class LedgerBookController extends Controller
    {
        
        private $model;
        public function __construct(){
            $this->model = new TransactionModel(); 
            $page = $_GET['page'];
            switch ($page) {
                
                case 'ledger_return_book':
                    $_SESSION['bookId'] = '';
                    $_SESSION['userId'] = '';
                    $data = array();
                    $books = $this->model->getAllBooks();
                    $users = $this->model->getAllUsers();
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
                        // var_dump($_GET['id']);
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