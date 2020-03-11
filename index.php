<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());
// $router->namespace("Source\Controllers");

/**
 * WEB ROUTES
 */
$router->namespace("Source\Controllers\Web");
$router->group(null);
$router->get("/", "Web:home", "web.home");
$router->get("/login", "Web:login", "web.login");
$router->get("/cadastrar", "Web:register", "web.register");
$router->get("/recuperar", "Web:forget", "web.forget");
$router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");


/**
 * AUTH
 */
$router->namespace("Source\Controllers");
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/register", "Auth:register", "auth.register");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");


/**
 * Admin Routes
 */
$router->namespace("Source\Controllers\Admin");
$router->group("/admin");
$router->get("/", "Admin:home", "admin.home");
$router->get("/sair", "Admin:logoff", "admin.logoff");

/**
 * Admin Tickets
 */
$router->get("/tickets", "Ticket:home", "tickets.home");
$router->post("/tickets/store", "Ticket:store", "tickets.store");
$router->post("/tickets/delete", "Ticket:delete", "tickets.delete");
// $route->get("/tickets/{ticket_id}", "Ticket:getTicket", "tickets.getTicket");
$router->post("/tickets/update", "Ticket:update", "tickets.update");





/**
 * ERRORS
 */
$router->group("ops");
$router->get("/{errcode}", "Web:error", "web.error");


/**
 * ROUT PROCESS
 */
$router->dispatch();

/**
 * ERRORS PROCESS
 */
if ($router->error()) {
    $router->redirect("web.error", ["errcode" => $router->error()]);
}

ob_end_flush();