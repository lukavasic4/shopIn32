<?php
namespace app\Controllers;
use app\Models\Database;
use app\Models\Register;

class RegController extends Controller{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function register(){
        $this->view("register",[
            "title" => "Register"
        ]);
    }
    public function registerUser(){
        if(isset($_POST['send'])){
            session_start();
            $code=null;
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $datum = time();
            $uloga_id = 1;

            $reIme="/^[A-Z][a-z]{1,20}$/";
            $rePrezime="/^[A-Z][a-z]{1,20}$/";
            $reEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/";
            $rePassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";

            $errors=[];

            if(!preg_match($reIme, $ime)){
                $errors[]="Wrong format of first name";
            }if(!preg_match($rePrezime, $prezime)){
                $errors[] = "Wrong format of last name";
            }
            if(!preg_match($rePassword, $password)){
                $errors[] = "Wrong format of password";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Wrong format of email";
            }
            if(count($errors) == 0){
                $registration = new Register($this->db);
                try {
                    $insert = $registration->registration($ime,$prezime,$email,$password,$uloga_id);
                    $code = 201;
                }catch (\PDOException $ex){
                    echo $ex->getMessage();
                    $code = 409;
                }
            }else{
                  $code = 422;
            }
        }
        http_response_code($code);
        echo json_encode($insert);
    }
}
