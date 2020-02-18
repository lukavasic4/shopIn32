<?php
namespace app\Models;
use app\Models\Database;

    class Register{
        public function __construct(Database $db)
        {
            $this->db = $db;
        }
        public function registration($ime,$prezime,$email,$password,$uloga_id){
            $upitInsert = "INSERT INTO korisnik(ime,prezime,email,lozinka,datum_registracije,uloga_id) VALUES(?,?,?,?,CURRENT_TIMESTAMP,?)";
            $this->db->executeNonGet($upitInsert,[$ime,$prezime,$email,$password,$uloga_id]);
        }
    }