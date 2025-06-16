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

        private $decryptedData;

        public function __construct(){
            $clave = KEY;
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
                'projection' => ['userName' => 1, '_id' => 1]  // incluir solo nombre y edad
            ]);

            
            //var_dump($this->decryptedData);
        }
        private function decryptData($data, $clave) {
            $data = base64_decode($data);
            $ivLength = openssl_cipher_iv_length('aes-128-cbc');
            $iv = substr($data, 0, $ivLength);
            $ciphertext = substr($data, $ivLength);
            return openssl_decrypt($ciphertext, 'aes-128-cbc', $clave, OPENSSL_RAW_DATA, $iv);
        }
        public function renderContent(){
            include "_view/Post.html";
        }
        public function renderJS(){
            include "js/Post.js";
        }
    }