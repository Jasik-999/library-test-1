<?php

namespace Controllers;

class Controller {
    protected postData;
    protected getData;

    public function __construct(){
        $this->postData = $_POST;
        $this->getData = $_GET;
    }

    public function getPostData(){
        return $this->postData;
    }
    public function getData(){
        return $this->getData;
    }

    public function index(){
        return include('views/home.php');
    }
}