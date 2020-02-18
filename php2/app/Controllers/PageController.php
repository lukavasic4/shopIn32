<?php
namespace app\Controllers;
use app\Models\Database;
use app\Models\Proizvodi;

class PageController extends Controller {
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function products(){
        $proizvodi = new Proizvodi($this->db);
        $sviProizvodi = $proizvodi->getAll();
        $kategorije = $proizvodi->getCategories();
       $this->view("products",[
                "title" => "Products",
                "products" => $sviProizvodi,
                "categories" => $kategorije
       ]);

    }
    public function home(){
        $proizvodihome = new Proizvodi($this->db);
        $home = $proizvodihome->get4products();
        $this->view("home",[
            "title" => "Home",
            "home" => $home
        ]);
    }
    public function contact(){
        $this->view("contact",[
                "title" => "Contact"
        ]);
    }
    public function login(){
        $this->view("login",[
            "title" => "Login",

        ]);
    }
    public function page404(){
        $this->view("404",[
            "title" => "404"
        ]);
    }
    public function single(){
        global $productController;
        $jedan = $productController->singleProduct();
        $this->view("single",[
            "title" => "Single",
            "one" => $jedan
        ]);
    }
}
