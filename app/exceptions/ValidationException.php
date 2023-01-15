<?php

class ValidationException extends Exception
{
    public $errors;

    public function __construct($errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    public function getError()
    {
        return $this->errors;
    }
}