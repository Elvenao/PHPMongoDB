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
        private $decryptedData;
        
        public function __construct(){
            $clave = KEY; // 16 bytes para AES-128
            
            $mongoDB = new MainModel();

            $this->collection = $mongoDB->findDocuments("Users");

            $this->cursor = $this->collection->find(
                [],
                [
                    'projection' => ['userName' => 1, 'name' => 1, 'birthDate' => 1, 'password' => 1, 'email' => 1, 'avatar' => 1, 'biography' => 1, 'genres' => 1]  // incluir solo nombre y edad
                ]
            );
            $this->decryptedData = [];
            foreach ($this->cursor as $element) {
                $element['userName'] = $this->decryptData($element['userName'], $clave);
                
                $element['name'] = $this->decryptData($element['name'], $clave);
                $element['birthDate'] = $this->decryptData($element['birthDate'], $clave);
                //$element['password'] = $this->decryptData($element['password'], $clave);
                //$element['email'] = $this->decryptData($element['email'], $clave);
                
                // Guardar o procesar $element según necesites
                $this->decryptedData[] = $element;
            }
            
            

        }

        private function decryptData($data, $clave) {
            $data = base64_decode($data);
            $ivLength = openssl_cipher_iv_length('aes-128-cbc');
            $iv = substr($data, 0, $ivLength);
            $ciphertext = substr($data, $ivLength);
            return openssl_decrypt($ciphertext, 'aes-128-cbc', $clave, OPENSSL_RAW_DATA, $iv);
        }
        public function renderContent(){
            include "_view/addUser.html";
        }
        public function renderJS(){
            include "js/addUser.js";
        }
        
    }