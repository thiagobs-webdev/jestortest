<?php

namespace Source\Controllers\Admin;

use Source\Controllers\Controller;
use Source\Models\User;
use Source\Models\Admin\Ticket as Ticke;

class Ticket extends AdminController
{
    /** @var User */
    protected $user;

    /**
     * Undocumented function
     *
     * @param [type] $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
        
    }

    public function home(): void
    {
        
        $head = $this->seo->optimize(
            "Tickets | " . site("name"),
            site("desc"),
            $this->router->route("tickets.home"),
            routeImage("Tickets"),
            false
        )->render();

        echo $this->view->render("jestoradm/widgets/tickets/home", [
            "head" => $head,
            "user" => $this->user,
            "tickets" => (new Ticke())->find()->order("created_at DESC")->fetch(true)
        ]);
    }

    public function store(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar o Ticket!"
            ]);
            return;
        }
        
        $ticket = new Ticke();
        $ticket->title = $data["title"];
        $ticket->description = $data["description"];
        $ticket->status = 1;
        
        if (!$ticket->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $ticket->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("tickets.home"),
            "type" => "success",
            "message" => "Ticket Cadastrado com Sucesso!"
        ]);
    }


    public function delete(array $data): void
    {
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $ticketDelete = (new Ticke())->findById($data["ticket_id"]);

            if (!$ticketDelete) {
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Você tentou deletar um Ticket que não existe!"
                ]);
                return;
            }

            
            $ticketDelete->destroy();
            
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("tickets.home"),
                "type" => "success",
                "message" => "Ticket exluído com Sucesso!"
            ]);
            return;
        }
    }


    public function update(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (in_array("", $data)) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Preencha todos os campos para cadastrar o Ticket!"
            ]);
            return;
        }

        if (!empty($data["ticketId"])) {
            $ticketId = filter_var($data["ticketId"], FILTER_VALIDATE_INT);
            $ticketEdit = (new Ticke())->findById($ticketId);
        }
        
        $ticketEdit->title = $data["title"];
        $ticketEdit->description = $data["description"];
        $ticketEdit->status = 1;
        
        if (!$ticketEdit->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $ticket->fail()->getMessage()
            ]);
            return;
        }

        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("tickets.home"),
            "type" => "success",
            "message" => "Ticket Cadastrado com Sucesso!"
        ]);
    }
}