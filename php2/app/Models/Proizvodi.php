<?php
namespace app\Models;
    class Proizvodi{
        private $db;
        const brojPoStrani=6;
        public function __construct(Database $db)
        {
            $this->db = $db;
        }
        public function getAll(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije");
        }
        public function getCategories(){
            return $this->db->executeQuery("SELECT * FROM kategorija");
        }
        public function get4products(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p LIMIT 4");
        }
        public function firstFilterForPrice(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.nova_cena BETWEEN 90 AND 110");
        }
        public function secondFilterForPrice(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.nova_cena BETWEEN 70 AND 89");
        }
        public function thirdFilterForPrice(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.nova_cena BETWEEN 50 AND 69");
        }
        public function fourthFilterForPrice(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.nova_cena BETWEEN 30 AND 49");
        }
        public function fifthFilterForPrice(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.nova_cena <= 30");
        }
        public function filterFirstCategories(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.idKategorije = 1");
        }
        public function filterSecondCategories(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.idKategorije = 2");
        }
        public function filterThirdCategories(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.idKategorije = 3");
        }
        public function filterFourthCategories(){
            return $this->db->executeQuery("SELECT * FROM proizvodi p INNER JOIN kategorija k ON k.id = p.idKategorije WHERE p.idKategorije = 4");
        }
        function getAllProductsForPag($limit=0){

            try{
                $limit=((int)$limit)*self::brojPoStrani;
                $offset=self::brojPoStrani;
                $upit="SELECT * FROM proizvodi LIMIT $limit, $offset";
                return $this->db->executeQueryWithParams($upit,[$limit,$offset]);
            }catch(PDOException $e){
                return null;
            }
        }

        function numberOfProducts($id=null){
            if($id){
                $query="SELECT COUNT(*) AS numOfProducts FROM proizvodi WHERE idKategorije=?";
                return $this->db->executeQueryFetch($query,[$id]);
            }else{
                $query="SELECT COUNT(*) AS numOfProducts FROM proizvodi";
                return $this->db->executeQuery($query);
            }
        }
        function numberOfPages(){

            $result=$this->numberOfProducts($id=null);
            $ukupanBrojProizvoda=$result[0]->numOfProducts;
            return ceil($ukupanBrojProizvoda/self::brojPoStrani);
        }

    }
