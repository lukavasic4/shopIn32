<?php
namespace app\Controllers;
use app\Models\Database;
use app\Models\Login;

class LoginController extends Controller
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login()
    {
        $this->view("login");
    }

    public function loginUser()
    {
        if (isset($_POST['btnLogin'])) {
            $code=null;
            $email = $_POST['email'];
            $password = $_POST['password'];

            $reEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/";
            $rePassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
            $errors = [];

            if (!preg_match($reEmail, $email)) {
                $errors[] = "Email nije u dobrom formatu.";
            }
            if (!preg_match($rePassword, $password)) {
                $errors[] = "Lozinka nije u dobrom formatu.";
            }
            if(count($errors) == 0){
                $login = new Login($this->db);
                try {
                    $log = $login->logUser($email,$password);
                    if($log){
                        $_SESSION['korisnik'] = $log;
                        $code = 201;
                    }
                    else{
                        $code = 409;
                    }
                }
                catch (\PDOException $e){
                    echo $e->getMessage();
                    $code = 404;
                }
            }
            else{
                $code = 422;
            }
        }
        http_response_code($code);
        echo json_encode($log);
    }
    public function logout(){
        session_destroy();
        header('Location: index.php?page=Home');
    }
}