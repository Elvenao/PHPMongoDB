<?php 
    require_once "config/global.php";
    class Error404Controller{
        public function renderContent(){
            include "_view/error404.html";
        }

        public function renderJS(){
            include "js/error404.js";
        }
    }