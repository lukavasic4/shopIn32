<?php
    session_start();
    require_once "app/Config/autoload.php";
    require_once "app/Config/config.php";
    use app\Models\Database;
    use app\Controllers\PageController;
    use app\Controllers\RegController;
    use app\Controllers\LoginController;
    use app\Controllers\MenuController;
    use app\Controllers\AdminController;
    use app\Controllers\ProductController;

 $db = new Database(SERVER, DATABASE, USERNAME, PASSWORD);

 $register = new RegController($db);
 $pageController = new PageController($db);
 $logController = new LoginController($db);
 $menuController = new MenuController($db);
 $adminController = new AdminController($db);
 $productController = new ProductController($db);

 if(isset($_GET['page'])){
    switch($_GET['page']){
        case "Home":
            $pageController->home();
            break;
        case "Products":
            $pageController->products();
            break;
        case "register":
            $register->register();
            break;
        case "login":
            $pageController->login();
            break;
        case "reg":
            $register->registerUser();
            break;
        case "Contact":
            $pageController->contact();
            break;
        case "loginU":
            $logController->loginUser();
            break;
        case "filter":
            $productController->filterProducts();
            break;
        case "filterCat":
            $productController->filterCategories();
            break;
        case "logout":
            $logController->logout();
            break;
        case "404":
            $pageController->page404();
            break;
        case "admin":
            $adminController->admin();
            break;
        case "deleteUser":
            $adminController->deleteU();
            break;
        case "getUser":
            $adminController->getUser();
            break;
        case "updateUser":
            $adminController->updateUser();
            break;
        case "insertUser":
            $adminController->insertUser();
            break;
        case "deleteProduct":
            $adminController->deleteProduct();
            break;
        case "insertProduct":
            $adminController->insertProduct();
            break;
        case "getProduct":
            $adminController->getProduct();
            break;
        case "updateProduct":
            $adminController->updateProduct();
            break;
        case "productPagination":
            $productController->productPagination();
            break;
    }
} else {
    $pageController->home();
}
?>