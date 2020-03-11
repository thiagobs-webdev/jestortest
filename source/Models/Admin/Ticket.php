<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Ticket extends DataLayer
{
    /**
     * Ticket Constructor
     */
    public function __construct()
    {
        parent::__construct("tickets", ["title", "description", "status"]);
    }

}
