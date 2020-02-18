<?php
namespace app\Models;
use app\Models\Database;
class Login{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function logUser($email,$password){
        session_start();
        $upit = "SELECT * FROM korisnik WHERE email = ? AND lozinka = ?";
        return $this->db->executeQueryFetch($upit,[$email,$password]);
    }
}