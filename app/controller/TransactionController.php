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

    public function search()
    {
        $books = $this->model->getAllBooks();
        $users = $this->model->getAllUsers();
        $transactions = $this->model->getAllTransactions();

        $this->view("transaction_search_advanced", [
            "books" => $books,
            "users" => $users,
            "transactions" => $transactions
        ]);
    }
}