<?php
namespace app\Models;
use app\Controllers\Controller;
use app\Controllers\MenuController;
class Meni extends Controller{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function menu(){
        return $this->db->executeQuery("SELECT * FROM meni");
    }
}
