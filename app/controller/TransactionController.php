<?php

require_once "app/model/TransactionModel.php";

class TransactionController
{
    private $model;

    public function __construct()
    {
        $this->model = new TransactionModel();
        $action = isset($_GET['action']) ? $_GET["action"] : "";

        switch ($action) {
            case "":
                $this->search();
                break;
            case "query":
                $this->query();
                break;
        }

    }

    private function view($view, $data = [])
    {
        extract($data);
        $view = "app/view/{$view}.php";
        include $view;
    }

    private function dd($data)
    {
        var_dump($data);
        die;
    }

    public function query()
    {
        $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : null;
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $query = [
            "book_id" => $book_id,
            "user_id" => $user_id,
            "status" => $status
        ];
        $data = $this->model->getAllTransactionByParam($query);
        header("Content-Type:application/json;charset=utf-8");
        echo json_encode([
            "data" => $data
        ]);
    }

    public function search()
    {
        $books = $this->model->getAllBooks();
        $users = $this->model->getAllUsers();
        $transactions = $this->model->getAllTransactions();

        return $this->view("transaction_search_advanced", [
            "books" => $books,
            "users" => $users,
            "transactions" => $transactions
        ]);
    }
}