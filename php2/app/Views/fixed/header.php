<div class="header">
<div class="container">
		<div class="head">
			<div class=" logo">
				<a href="index.php?page=Home"><img src="app/Assets/images/logo.png" alt=""></a>
			</div>
		</div>
	</div>
	<div class="header-top">
		<div class="container">
		<div class="col-sm-5 col-md-offset-2  header-login">
					<ul >
                        <?php
                            if(!isset($_SESSION['korisnik'])):
                        ?>
						<li><a href="index.php?page=login">Login</a></li>
						<li><a href="index.php?page=register">Register</a></li>
                        <?php endif; ?>
                        <?php
                        if(isset($_SESSION['korisnik'])):
                        ?>
						<li><a href="index.php?page=logout">Logout</a></li>
                        <?php endif; ?>
					</ul>
				</div>
				
			<div class="col-sm-5 header-social">		
					<ul >
						<li><a href="https://twitter.com/?lang=sr"><i></i></a></li>
						<li><a href="https://www.facebook.com/"><i class="ic1"></i></a></li>
						<li><a href="https://www.linkedin.com/"><i class="ic3"></i></a></li>
						<li><a href="https://rss.com/"><i class="ic4"></i></a></li>
					</ul>
					
			</div>
				<div class="clearfix"> </div>
		</div>
		</div>
		
		<div class="container">
		
			<div class="head-top">
			
		 <div class="col-sm-8 col-md-offset-2 h_menu4">
            <?php include "nav.php"; ?>
			</div>
			<div class="col-sm-2 search-right">
					<div class="cart box_1">
						<a href="#" class="korpa">
						<h3> <div class="total">
							<span></span></div>
							<img src="app/Assets/images/cart.png" alt=""/></h3>
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

					</div>
					<div class="clearfix"> </div>
					
						<!----->

						<!---pop-up-box---->					  
			<link href="app/Assets/css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
			<script src="app/Assets/js/jquery.magnific-popup.js" type="text/javascript"></script>
			<!---//pop-up-box---->
			<div id="small-dialog" class="mfp-hide">
				<div class="search-top">
					<div class="login-search">
						<input type="submit" value="">
						<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}">		
					</div>
					<p>Shopin</p>
				</div>				
			</div>
		 <script>
			$(document).ready(function() {
			$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
			});
																						
			});
		</script>		
						<!----->
			</div>
			<div class="clearfix"></div>
		</div>	
	</div>	
</div>