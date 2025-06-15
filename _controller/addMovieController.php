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
        
        public function __construct(){
            
        }
        public function renderContent(){
            include "_view/addMovie.html";
        }
        public function renderJS(){
            include "js/addMovie.js";
        }
        
    }