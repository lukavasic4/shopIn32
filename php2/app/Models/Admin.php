<?php
namespace app\Models;
use app\Models\Database;
class Admin{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function getUsers(){
    return $this->db->executeQuery("SELECT * FROM korisnik");
    }
    public function getProducts(){
        return $this->db->executeQuery("SELECT * FROM proizvodi");
    }
    public function getRoles(){
        return $this->db->executeQuery("SELECT * FROM uloga");
    }
    public function getCategories(){
        return $this->db->executeQuery("SELECT * FROM kategorija");
    }
    public function deleteUser($id){
        $sql = "DELETE FROM korisnik WHERE korisnik_id = ?";
        return $this->db->executeNonGet($sql,[$id]);
    }
    public function getChoosenUser($id){
        $upit = "SELECT korisnik_id, ime, prezime ,email ,lozinka , u.naziv_uloge FROM korisnik k INNER JOIN uloga u ON k.uloga_id = u.idUloga WHERE k.korisnik_id = ?";
        return $this->db->executeQueryFetch($upit,[$id]);
    }
    public function updateChoosenUser($idUpdate,$ime,$prezime,$email,$password,$role){
        $query = "UPDATE korisnik SET ime = ?, prezime = ?, email = ?, lozinka = ?, uloga_id = ? WHERE korisnik_id = ?";
        return $this->db->executeNonGet($query,[$ime,$prezime,$email,$password,$role,$idUpdate]);
    }
    public function getAllUsers(){
        return $this->db->executeQuery("SELECT * FROM korisnik");
    }
    public function insertUser($addFirstName,$addLastName,$addEmail,$addPassword,$addRole){
        $insert = "INSERT INTO korisnik(ime,prezime,email,lozinka,datum_registracije,uloga_id) VALUES(?,?,?,?,CURRENT_TIMESTAMP,?)";
        return $this->db->executeNonGet($insert,[$addFirstName,$addLastName,$addEmail,$addPassword,$addRole]);
    }
    public function deleteProduct($id){
        $sql = "DELETE FROM proizvodi WHERE idProizvod = ?";
        return $this->db->executeNonGet($sql,[$id]);
    }
    public function getChoosenProduct($id){
        $upitProduct = "SELECT idProizvod, naziv_proizvoda, pol, stara_cena, nova_cena, slika, idKategorije FROM proizvodi WHERE idProizvod = ?";
        return $this->db->executeQueryFetch($upitProduct,[$id]);
    }
    public function updateProduct($id,$naziv,$pol,$stara,$nova,$slika,$kategorija){
        $query = "UPDATE proizvodi SET naziv_proizvoda = ?, pol = ?, stara_cena = ?, nova_cena = ?, slika = ?, idKategorije = ? WHERE idProizvod = ?";
        return $this->db->executeNonGet($query,[$naziv,$pol,$stara,$nova,$slika,$kategorija,$id]);
    }
    public function insertProduct($productName,$gender,$oldPrice,$newPrice,$putanjaOriginalnaSlika,$categories){
        $upit = "INSERT INTO proizvodi(naziv_proizvoda, pol, stara_cena, nova_cena, slika, idKategorije) VALUES(?,?,?,?,?,?)";
        return $this->db->executeNonGet($upit,[$productName,$gender,$oldPrice,$newPrice,$putanjaOriginalnaSlika,$categories]);
    }
}
