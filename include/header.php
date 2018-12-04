<?php ini_set("display_error",0);
@session_start();
// var_dump($_SESSION["customer"]);
?>
<!--header-->
<div class="line">
	
</div>
<div class="header" style="
background-color: #333;
position: fixed;
top: 0;
width: 100%; z-index: 100">
<div class="logo">
	<a href="."><img src="public/images/logo.png" alt="" ></a>
</div>

<div  class="header-top">
	<div class="header-grid">

		<ul class="header-in">
			<li>
				<?php if(!isset($_SESSION["customer"])) { ?>
				<a href="login.php">Login   </a> 
				<?php }  elseif ($_SESSION["customer"]->image != '') { ?>
				<a href="profile.php"><img class="img-circle" src="admin/public/images/<?php echo $_SESSION["customer"]->image ?>" width="30px"></a>
				<?php }  elseif ($_SESSION["customer"]->image == '') { ?>
				<a href="profile.php" ><img class="img-circle" src="admin/public/images/us.png" width="50px"></a>
				<?php } ?>
			</li>
			<li>
				<select name="change_language">
					<option <?php echo isset($_SESSION["en"])?"selected":""?> value="en">English</option>
					<option <?php echo isset($_SESSION["vn"])?"selected":""?> value="vn">VietNam</option>
				</select>
			</li>
		</ul>


		<div class="search-box">
			<div id="sb-search" class="sb-search">
				<form method="POST" action="product_search.php">
					<input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
					<input class="sb-search-submit" type="submit" name="search_product" id="id_search">
					<span class="sb-icon-search"> </span>
				</form>
			</div>
		</div>

		<!-- search-scripts -->
		<script src="public/js/classie.js"></script>
		<script src="public/js/uisearch.js"></script>
		<script>
			new UISearch( document.getElementById( 'sb-search' ) );
		</script>
		<!-- //search-scripts -->
		<div class="online">
			<a data-toggle="modal" id="checkout" href="#checkout_cart" data-index="<?php echo isset($_SESSION["cart"])?count($_SESSION["cart"]):0 ?>" ><i style="font-size: 30px" class="fa fa-shopping-cart"></i> (<span id="cart_quantity"><?php echo (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0)?count($_SESSION["cart"]):"Empty" ?></span>)</a>
		</div>
		<div class="clearfix"> </div>
	</div>
	<div class="header-bottom">
		<div class="h_menu4"><!-- start h_menu4 -->
			<a class="toggleMenu" href="#">Menu</a>
			<ul class="nav">
				<?php
				include("admin/models/m_categories.php");
				$m_category = new M_Categories();
				$categories = $m_category->read_all_categories();
				foreach($categories as $c):
					$sub_cate = $m_category->read_cate_by_parent($c->id);
					$count = count($sub_cate);
					?>
					<?php if($count == 0 && $c->parent_id == 0) {?>
					<li class=""><a href="products.php?cate_id=<?php echo $c->id?>"><?php echo $c->name?></a></li>
					<?php } elseif($count !=0 && $c->parent_id ==0 ) {?>
					<li class=""><a href="products.php?cate_id=<?php echo $c->id?>"><?php echo $c->name?> <i> </i></a>
						<ul>
							<?php foreach($sub_cate as $sc): ?>
								<li class=""><a href="products.php?cate_id=<?php echo $sc->id?>"><?php echo $sc->name?></a></li>
							<?php endforeach ?>
						</ul>
					</li>	

					<?php } endforeach?>
					<li><a href="promotion.php">Promotion</a></li>
					<li><a href="contact.php">Contact us</a></li>

				</ul>
				<script type="text/javascript" src="public/js/nav.js"></script>
			</div>

			<!-- end h_menu4 -->
					<!-- <ul class="header-bottom-in">
						<li ><select class="drop">
							  <option value="Dollars" class="in-of">Get Active</option>
							  <option value="Euro" class="in-of">Get Active1</option>
							  <option value="Yen" class="in-of">Get Active2</option>
							</select> </li>
						<li ><select class="drop">
							  <option value="Dollars" class="in-of">Community</option>
							  <option value="Euro" class="in-of">Community1</option>
							  <option value="Yen" class="in-of">Community2</option>
							</select></li>		
						</ul> -->
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>


			<?php include("views/cart/v_show_cart.php"); ?>
			<!---->

<!---->

<script type="text/javascript">
	$(document).on('submit','#id_search',function(){
		alert(1);
	})
</script>