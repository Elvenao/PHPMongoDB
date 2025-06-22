<?php
    require_once 'vendor/autoload.php';
    require_once '_model/MainModel.php';
    require_once "config/global.php";

    class AddMovieController{
        private $cursor;
        private  $db;
        private $json;
        private $client;
        private $collection;
        private $decryptedData;

        public function __construct() {
            $mongoDB = new MainModel();

            $this->collection = $mongoDB->findDocuments("Movies");

            $this->cursor = $this->collection->find();

            $this->decryptedData = [];

            foreach ($this->cursor as $element) {
                $element['_id'] = (string)$element['_id']; // Convertir ObjectId a string si lo usarás en HTML/JS
                $this->decryptedData[] = $element;
            }
        }
        
        public function renderContent(){
            include "_view/addMovie.html";
        }
        public function renderJS(){
            include "js/addMovie.js";
        }
        
    }