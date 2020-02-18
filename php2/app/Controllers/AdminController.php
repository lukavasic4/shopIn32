<?php
namespace app\Controllers;
use app\Models\Admin;
use app\Models\Database;
use app\Models\Proizvodi;

class AdminController extends Controller{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function admin(){
        if(!isset($_SESSION['korisnik'])) {
            header('Location:index.php?page=404');
        }elseif ($_SESSION['korisnik']->uloga_id == "1"){
            header('Location:index.php?page=404');
        }elseif ($_SESSION['korisnik'] == null){
            header('Location:index.php?page=404');
        }else{
        $admin = new Admin($this->db);
        $proizvod = new Proizvodi($this->db);
        $allUsers = $admin->getUsers();
        $allRoles = $admin->getRoles();
        $allProducts = $proizvod->getAll();
        $allCategories = $admin->getCategories();
        $this->view("admin", [
            "title" => "Admin page",
            "users" => $allUsers,
            "roles" => $allRoles,
            "products" => $allProducts,
            "categories" => $allCategories
        ]);}
    }
    public function deleteU(){
        $code = null;
        if(isset($_POST['btnDelete'])){
            $id = $_POST['id'];
            try{
                $admin = new Admin($this->db);
                $delete = $admin->deleteUser($id);
                $all = $admin->getAllUsers();
                $code = 201;
                echo json_encode($all);
            }catch (\PDOException $e){
                echo $e->getMessage();
                $code = 500;
            }
        }else{
            $code = 500;
        }
        http_response_code($code);
    }
    public function getUser(){
        $code = null;
        if(isset($_GET['btnUpdate'])){
            $id = $_GET['idUpdate'];
            try{
                $admin = new Admin($this->db);
                $get = $admin->getChoosenUser($id);
                $code = 201;
                echo json_encode($get);
            }catch (\PDOException $exception){
                echo $exception->getMessage();
                $code = 500;
            }
        }else{
            $code = 500;
        }
        http_response_code($code);

    }
    public function updateUser(){
        $code = null;
        if(isset($_POST['btnSend'])){
            $idUpdate = $_POST['idUpdate'];
            $ime = $_POST['firstName'];
            $prezime = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['passwordUpdate'];
            $role = $_POST['updateRole'];
            try{
                $admin = new Admin($this->db);
                $update = $admin->updateChoosenUser($idUpdate,$ime,$prezime,$email,$password,$role);
                $all = $admin->getAllUsers();
                echo json_encode($all);
                $code = 201;
            }catch (\PDOException $e){
                echo $e->getMessage();
                $code = 500;
            }
        }else{
            $code = 500;
        }
        http_response_code($code);
    }
    public function insertUser(){
        $code = null;
        if(isset($_POST['btnInsert'])){
            $addFirstName = $_POST['addFirstName'];
            $addLastName = $_POST['addLastName'];
            $addEmail = $_POST['addEmail'];
            $addPassword = $_POST['addPassword'];
            $addRole = $_POST['addRole'];

            $reFirst="/^[A-Z][a-z]{1,20}$/";
            $reLast="/^[A-Z][a-z]{1,20}$/";
            $reEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/";
            $rePassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
            $errors=[];

            if(!preg_match($reFirst, $addFirstName)){
                $errors[]="Wrong format of first name";
            }if(!preg_match($reLast, $addLastName)){
                $errors[] = "Wrong format of last name";
            }
            if(!preg_match($rePassword, $addPassword)){
                $errors[] = "Wrong format of password";
            }
            if(!filter_var($addEmail, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Wrong format of email";
            }
            if(count($errors) == 0){
                try{
                    $admin = new Admin($this->db);
                    $insertU = $admin->insertUser($addFirstName,$addLastName,$addEmail,$addPassword,$addRole);
                    $all = $admin->getAllUsers();
                    $code = 201;
                    echo json_encode($all);
                }catch (\PDOException $e){
                    echo $e->getMessage();
                    $code = 500;
                }
            }else{
                $code = 500;
            }
        }else{
            $code = 500;
        }
        http_response_code($code);
    }
    public function deleteProduct(){
        $code = null;
        if(isset($_POST['delete'])){
            $idDelete = $_POST['value'];
            try {
                $admin = new Admin($this->db);
                $delete = $admin->deleteProduct($idDelete);
                $all = $admin->getProducts();
                $code = 201;
                echo json_encode($all);
            }catch (\PDOException $e){
                echo $e->getMessage();
                $code = 500;
            }
        }else{
            $code = 500;
        }
        http_response_code($code);
    }
    public function insertProduct()
    {
        $code = null;
        if (isset($_POST['btnAddProduct'])) {
            $productName = $_POST['addName'];
            $gender = $_POST['pol'];
            $oldPrice = $_POST['addOld'];
            $newPrice = $_POST['addNew'];
            $slika_naziv = $_FILES['addFoto']['name'];
            $slika_tmpLokacija = $_FILES['addFoto']['tmp_name'];
            $slika_tip = $_FILES['addFoto']['type'];
            $slika_velicina = $_FILES['addFoto']['size'];
            $categories = $_POST['addCat'];
            $greske = [];
            $dozvoljeni_tipovi = ['image/jpg', 'image/jpeg', 'image/png'];

            if (!in_array($slika_tip, $dozvoljeni_tipovi)) {
                array_push($greske, "Pogresan tip fajla. - Profil slika");
            }
            if ($slika_velicina > 3000000) {
                array_push($greske, "Maksimalna velicina fajla je 3MB. - Profil slika");
            }
            if (count($greske) == 0) {
                list($sirina, $visina) = getimagesize($slika_tmpLokacija);

                $postojecaSlika = null;
                switch ($slika_tip) {
                    case 'image/jpeg':
                        $postojecaSlika = imagecreatefromjpeg($slika_tmpLokacija);
                        break;
                    case 'image/png':
                        $postojecaSlika = imagecreatefrompng($slika_tmpLokacija);
                        break;
                }


                $novaSirina = 720;
                $novaVisina = 923;

                $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);

                imagecopyresampled($novaSlika, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
                $naziv = time() . $slika_naziv;
                $putanjaNovaSlika = 'app/Assets/images/nova_' . $naziv;

                switch ($slika_tip) {
                    case 'image/jpeg':
                        imagejpeg($novaSlika, $putanjaNovaSlika, 75);
                        break;
                    case 'image/png':
                        imagepng($novaSlika, $putanjaNovaSlika);
                        break;
                }

                $putanjaOriginalnaSlika = 'app/Assets/images/' . $naziv;
                if(move_uploaded_file($slika_tmpLokacija,''.$putanjaOriginalnaSlika)){
                    try {
                        $admin = new Admin($this->db);
                        $insert = $admin->insertProduct($productName,$gender,$oldPrice,$newPrice,$putanjaOriginalnaSlika,$categories);
                        header('Location:index.php?page=admin');
                        $code = 201;
                    } catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
                }
            } else {
                $code = 500;
            }
            http_response_code($code);
        }
    }
    public function getProduct(){
        $code = null;
        if(isset($_GET['Update'])){
            $id = $_GET['value'];
            try {
                $admin = new Admin($this->db);
                $get = $admin->getChoosenProduct($id);
                $code = 201;
                echo json_encode($get);
            }catch (\PDOException $e){
                $code = 500;
            }
        }else{
        $code = 500;
        }
        http_response_code($code);
    }
    public function updateProduct(){
        $code =null;
        if(isset($_POST['updateSend'])){
            $id = $_POST['productId'];
            $naziv = $_POST['productName'];
            $pol = $_POST['gender'];
            $stara = $_POST['oldPrice'];
            $nova = $_POST['newPrice'];
            $slika = $_POST['slika'];
            $kategorija = $_POST['categories'];
            try {
                $admin = new Admin($this->db);
                $update = $admin->updateProduct($id,$naziv,$pol,$stara,$nova,$slika,$kategorija);
                $all = $admin->getProducts();
                $code = 201;
                echo json_encode($all);
            }
            catch (\PDOException $ex){
                echo $ex->getMessage();
                $code = 500;
            }
        }else{
            $code = 500;
        }
        http_response_code($code);
    }
}
