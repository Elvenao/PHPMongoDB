<?php
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/Prueba/';
    $server = $protocol . $_SERVER['HTTP_HOST'];
    define("SERVER",$server);
    define("SITE_URL", $base_url);
    define("RUTA_DEFAULT_LOGGED", "reportes/");
    define("RUTA_DEFAULT_UNLOGGED","login/");
    define("CLAVE_SECRETA","e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855");

