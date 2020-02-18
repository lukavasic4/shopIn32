<div class="banner">
    <div class="container">
        <section class="rw-wrapper">
            <h1 class="rw-sentence">
                <span>Fashion &amp; Beauty</span>
                <div class="rw-words rw-words-1">
                    <span>Beautiful Design</span>
                    <span>Sale</span>
                    <span>Men</span>
                    <span>Women</span>
                    <span>Fashion weeks</span>
                    <span>Seasonal discounts</span>
                </div>
                <div class="rw-words rw-words-2">
                    <span>Final SALE</span>
                    <span>Jackets</span>
                    <span>Coats</span>
                    <span>Shirts</span>
                    <span>Loyality card</span>
                    <span>Shopin COMPANY</span>
                </div>
            </h1>
        </section>
    </div>
</div>
<!--content-->
<div class="content">
    <div class="container">
        <div class="content-top">
            <div class="col-md-6 col-md">
                <div class="col-1">
                    <a href="index.php?page=Products" class="b-link-stroke b-animate-go  thickbox">
                        <img src="app/Assets/images/pi.jpg" class="img-responsive" alt=""/><div class="b-wrapper1 long-img"><p class="b-animate b-from-right    b-delay03 ">FINAL</p><label class="b-animate b-from-right    b-delay03 "></label><h3 class="b-animate b-from-left    b-delay03 ">SALE</h3></div></a>
                </div>
                <div class="col-2">
                    <span>Hot Deal</span>
                    <h2><a href="index.php?page=Products">Luxurious &amp; Trendy</a></h2>
                    <p>Be the frist to know about the latest fashion news and get exclu-sive offers</p>
                    <a href="index.php?page=Products" class="buy-now">Buy Now</a>
                </div>
            </div>
            <div class="col-md-6 col-md1">
                <div class="col-3">
                    <a href="index.php?page=Products"><img src="app/Assets/images/pi1.jpg" class="img-responsive" alt="">
                        <div class="col-pic">
                            <h5>For Men</h5>
                        </div></a>
                </div>
                <div class="col-3">
                    <a href="index.php?page=Products"><img src="app/Assets/images/pi2.jpg" class="img-responsive" alt="">
                        <div class="col-pic">
                            <h5>For Kids</h5>
                        </div></a>
                </div>
                <div class="col-3">
                    <a href="index.php?page=Products"><img src="app/Assets/images/pi3.jpg" class="img-responsive" alt="">
                        <div class="col-pic">
                            <h5>For Women</h5>
                        </div></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!--products-->
        <div class="content-mid">
            <h3>Trending Items</h3>
            <label class="line"></label>
            <div class="mid-popular">
                <?php
                foreach($home as $h):
                ?>
                <div class="col-md-3 item-grid simpleCart_shelfItem" data-id="<?= $h->idProizvod; ?>">
                    <div class=" mid-pop">
                        <div class="pro-img">
                            <img src="<?= $h->slika; ?>" class="img-responsive" alt="">
                        </div>
                        <div class="mid-1">
                            <div class="women">
                                <div class="women-top">
                                    <span><?= $h->pol; ?></span>
                                    <h6><a href="single.html"><?= $h->naziv_proizvoda; ?></a></h6>
                                </div>
                                <?php if(isset($_SESSION['korisnik'])): ?>
                                    <div class="img korpa">
                                        <a href="#"><img src="app/Assets/images/ca.png" alt=""></a>
                                    </div>
                                <?php endif; ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="mid-2">
                                <p ><label>$<?= $h->stara_cena; ?>.00</label><em class="item_price">$<?= $h->nova_cena; ?>.00</em></p>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div>
            </div>
    </div>

