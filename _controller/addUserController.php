<?php
    require_once 'vendor/autoload.php';
    require_once '_model/MainModel.php';
    require_once "config/global.php";
    class AddUserController{
        private $cursor;
        private  $db;
        private $json;
        private $client;
        private $collection;

        public function __construct(){
            $mongoDB = new MainModel();

            $this->collection = $mongoDB->findDocuments("Users");

            $this->cursor = $this->collection->find(
                [],
                [
                    'projection' => ['userName' => 1, 'name' => 1, 'birthDate' => 1, 'password' => 1, 'email' => 1, 'avatar' => 1 ]  // incluir solo nombre y edad
                ]
            );
            

        }
        public function renderContent(){
            include "_view/addUser.html";
        }
        public function renderJS(){
            include "js/addUser.js";
        }
    }