<?php
require "../model/BookHistoryModel.php";

class BookHistoryController extends Controller
{
    private $model;
    private $view;
    function __construct()
    {
        $this->model = new BookHistoryModel();
    }

    function view()
    {
        $this->view->content = $this->model->getHitory();
        $this->view->render('book_history');
    }
}
