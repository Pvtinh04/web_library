<?php
require_once "app/model/TransactionModel.php";
class BookHistoryController extends Controller
{
    private $model;
    private $view;
    function __construct()
    {
        $this->model = new TransactionModel();
    }

    function view()
    {
        $this->view->content = $this->model->getHitory();
        $this->view->render('book_history');
    }
}