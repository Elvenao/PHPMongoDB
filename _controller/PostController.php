<?php
    require_once 'vendor/autoload.php';
    require_once '_model/MainModel.php';
    require_once "config/global.php";
    class PostController{
        private $cursor;
        private  $db;
        private $json;
        private $client;
        private $collection;

        private $users;
        private $usersCursor;

        public function __construct(){
            $mongoDB = new MainModel();

            $this->collection = $mongoDB->findDocuments("Posts");

            $this->cursor = $this->collection->find(
                [],
                [
                    'projection' => ['user' => 1, '_id' => 1,'userId' => 1, 'content' => 1, 'date' => 1, 'time' => 1, 'title' => 1]  // incluir solo nombre y edad
                ]
            );
            $this->users = $mongoDB->findDocuments("Users");
            $this->usersCursor = $this->users->find([],[
                'projection' => ['nombre' => 1, '_id' => 1]  // incluir solo nombre y edad
            ]);
            

        }
        public function renderContent(){
            include "_view/Post.html";
        }
        public function renderJS(){
            include "js/Post.js";
        }
    }