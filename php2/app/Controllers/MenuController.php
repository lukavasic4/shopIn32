<?php
namespace app\Controllers;
use app\Models\Database;
use app\Models\Meni;

class MenuController{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function getMeni(){
        $meni = new Meni($this->db);
        return $meni->menu();
    }
}
