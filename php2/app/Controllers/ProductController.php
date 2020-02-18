<?php
namespace app\Controllers;
use app\Models\Database;
use app\Models\Proizvodi;

class ProductController extends Controller{
    private $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function filterProducts(){
        $code = null;
        if(isset($_POST['poslato'])){
            $vrednost = $_POST['value'];
            $proizvodi = new Proizvodi($this->db);
            if($vrednost == 1){
                $rez = $proizvodi->getAll();
                $code = 201;
            }
            else if($vrednost == 2){
                $rez = $proizvodi->firstFilterForPrice();
                $code = 201;
            }
            else if($vrednost == 3){
                $rez = $proizvodi->secondFilterForPrice();
                $code = 201;
            }
            else if ($vrednost == 4){
                $rez = $proizvodi->thirdFilterForPrice();
                $code = 201;
            }
            else if($vrednost == 5){
                $rez = $proizvodi->fourthFilterForPrice();
                $code = 201;
            }
            else if($vrednost == 6){
                $rez = $proizvodi->fifthFilterForPrice();
                $code = 201;
            }else if($vrednost == null){
                $code = 422;
            }

        }
        http_response_code($code);
        echo json_encode($rez);
    }
    public function filterCategories(){
        $code = null;
        if(isset($_POST['send'])){
            $value = $_POST['value'];
            $proizvod = new Proizvodi($this->db);
            if($value == 0){
                $pr = $proizvod->getAll();
                $code = 201;
            }
            elseif ($value == 1){
                $pr = $proizvod->filterFirstCategories();
                $code = 201;
            }
            elseif ($value == 2){
                $pr = $proizvod->filterSecondCategories();
                $code = 201;
            }
            elseif ($value == 3){
                $pr = $proizvod->filterThirdCategories();
                $code = 201;
            }
            elseif ($value == 4){
                $pr = $proizvod->filterFourthCategories();
                $code = 201;
            }
            else{
                $code = 422;
            }
        }else{
            $code = 422;
        }
        http_response_code($code);
        echo json_encode($pr);
    }
    public function productPagination(){
        if(isset($_POST['page'])){
            header("Content-type:application/json");
            $page=$_POST['page'];
            $proizvodi=new Proizvodi($this->db);
            $pr=$proizvodi->getAllProductsForPag($page);
            $brojProizvoda=$proizvodi->numberOfPages();
            echo json_encode([
                "proizvodi"=>$pr,
                "numOfProducts"=>$brojProizvoda
            ]);
        }
    }
}
