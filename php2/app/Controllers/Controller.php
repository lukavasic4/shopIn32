<?php
namespace  app\Controllers;
    class Controller{
        protected function view($file,$data =[]){
          extract($data);
            include "app/Views/fixed/head.php";
            include "app/Views/fixed/header.php";
            include "app/Views/pages/$file.php";
            include "app/Views/fixed/brand.php";
            include "app/Views/fixed/footer.php";
        }
    }
