<?php

/**
 * SITE CONFIG
 * http://localhost/jestortest
 */
define("SITE", [
    "name" => "Tickets para atendimento de demandas.",
    "desc" => "App test do processo seletivo Jestor para gerenciamento de Tickets.",
    "domain" => "jestortest.thiagobs.me/",
    "locale" => "pt_BR",
    "root" => "http://localhost/jestortest"
]);


/**
 * VIEW
 */
define("CONF_VIEW_EXT", "php");


/**
 * SITE MINIFY
 */
if ($_SERVER["SERVER_NAME"] == "localhost") {
    // require __DIR__ . "/Minify.php";
}

/**
 * DATABASE
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "your_bd",
    "username" => "your_user",
    "passwd" => "your_password",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);


/**
 * SOCIAL CONFIG
 */
define("SOCIAL", [
    "facebook_page" => "jestor",
    "facebook_author" => "jestor",
    "facebook_appId" => "11111111",
    "twitter_creator" => "jestor",
    "twitter_site" => "jestor",
]);


/**
 * MAIL CONNECT
 */

define("MAIL", [
    "host" => "smtp.sendgrid.net",
    "port" => "587",
    "user" => "apikey",
    "passwd" => "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",
    "from_name" => "Thiago Bomfim",
    "from_email" => "thiagobs.webdev@gmail.com"
]);
