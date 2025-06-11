<?php 
    require_once "config/global.php";
    class MenuController{
        public function renderContent(){
            include "_view/menu.html";
        }
        public function renderJS(){
            include "js/menu.js";
        }
    }