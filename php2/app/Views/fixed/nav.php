<nav class="navbar nav_bottom" role="navigation">
 
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header nav_2">
      <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
   </div> 
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
        <ul class="nav navbar-nav nav_1">
           <?php
           global $menuController;
           $meni = $menuController->getMeni();
           foreach ($meni as $m):
           ?>
               <li><a class="color3" href="index.php?page=<?=$m->naziv ?>"><?= $m->naziv; ?></a></li>
            <?php endforeach; ?>
            <?php
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->uloga_id == "2"):
                ?>
                <li><a href="index.php?page=admin">Admin page</a></li>
            <?php endif; ?>
        </ul>
     </div><!-- /.navbar-collapse -->

</nav>