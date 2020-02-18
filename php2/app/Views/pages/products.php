<div class="banner-top">
	<div class="container">
		<h1>Products</h1>
		<em></em>
		<h2><a href="index.php?page=Home">Home</a><label>/</label>Products</h2>
	</div>
</div>
<div class="product">
    <div class="container">
        <div class="col-md-9">
            <div class="mid-popular" id="proizvodi">
                <?php
                foreach($products as $p):
                ?>
                <div class="col-md-4 item-grid1 simpleCart_shelfItem" data-cat="<?= $p->id; ?>">
                    <div class="mid-pop">
                        <div class="pro-img">
                            <img src="<?= $p->slika; ?>" class="img-responsive" alt="">
                            <div class="zoom-icon ">
                                <a class="picture" href="<?= $p->slika; ?>" rel="title" class="b-link-stripe thickbox"><i class="glyphicon glyphicon-search icon "></i></a>
                            </div>
                        </div>
                        <div class="mid-1">
                            <div class="women">
                                <div class="women-top">
                                    <span><?= $p->pol; ?></span>
                                    <h6><a href=""><?= $p->naziv_proizvoda; ?></a></h6>
                                </div>
                                <?php if(isset($_SESSION['korisnik'])): ?>
                                <div class="img item_add korpa">
                                    <a href="#"><img src="app/Assets/images/ca.png" alt=""></a>
                                </div>
                                <?php endif; ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="mid-2">
                                <p ><label>$<?= $p->stara_cena; ?>.00</label><em class="item_price">$<?= $p->nova_cena; ?>.00</em></p>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>

            </div>
            <div class="page-heade">
                <ul class="pagination" role="tablist" id="paginacija">

                </ul>
            </div>
        </div>
        <div class="col-md-3 product-bottom">
            <!--categories-->
            <div class=" rsidebar span_1_of_left" id="kategorije">
                <h4 class="cate">Categories</h4>
                <ul class="menu-drop"> <li class="item1"><a href="#" data-id="0" >All products</a></li>
                    <?php
                    foreach($categories as $k):
                    ?>
                    <li class="item1"><a href="#" data-id="<?= $k->id; ?>" ><?= $k->naziv_kategorije; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!--initiate accordion-->
            <script type="text/javascript">
                $(function() {
                    var menu_ul = $('.menu-drop > li > ul'),
                        menu_a  = $('.menu-drop > li > a');
                    menu_ul.hide();
                    menu_a.click(function(e) {
                        e.preventDefault();
                        if(!$(this).hasClass('active')) {
                            menu_a.removeClass('active');
                            menu_ul.filter(':visible').slideUp('normal');
                            $(this).addClass('active').next().stop(true,true).slideDown('normal');
                        } else {
                            $(this).removeClass('active');
                            $(this).next().stop(true,true).slideUp('normal');
                        }
                    });

                });
            </script>
            <!--//menu-->
            <section  class="sky-form">
                <h4 class="cate">Price</h4>
                <div class="row row1 scroll-pane">
                    <div class="col col-4">
                        <label class="checkbox"><input type="checkbox" value="1" class="cena" name="checkbox[]"><i></i>All products</label>
                        <label class="checkbox"><input type="checkbox" value="2" class="cena" name="checkbox[]"><i></i>$110 - $90</label>
                        <label class="checkbox"><input type="checkbox" value="3" class="cena" name="checkbox[]"><i></i>$89 - $70</label>
                        <label class="checkbox"><input type="checkbox" value="4" class="cena" name="checkbox[]"><i></i>$69 - $50 </label>
                        <label class="checkbox"><input type="checkbox" value="5" class="cena" name="checkbox[]"><i></i>$49 - $30</label>
                        <label class="checkbox"><input type="checkbox" value="6" class="cena" name="checkbox[]"><i></i>Under $30</label>
                    </div>
                </div>
            </section>


            <!---->
        </div>
        <div class="clearfix"></div>
    </div>
</div>
    <script src="app/Assets/js/proizvodi.js" type="text/javascript" ></script>
