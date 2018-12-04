<?php include("include/report.php") ?>
<div class="banner" style="margin-top: 100px">
	<div class="container">
		<div class="banner-matter">
			<h1>Get excercise  get gym<span>push your limits</h1>
				<div class="out">
					<a href="products.php" class="shop">SHOP</a>
					<div class="clearfix"> </div>
				</div>
			</div>	
		</div>
	</div>

	<div class="content">
		<div class="sport-your">
			<!-- requried-jsfiles-for owl -->
			<link href="public/css/owl.carousel.css" rel="stylesheet">
			<script src="public/js/owl.carousel.js"></script>
			<script>
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
						items : 5,
						lazyLoad : true,
						autoPlay : true,
						navigation : true,
						navigationText :  true,
						pagination : false,
					});
				});
			</script>
			<!-- //requried-jsfiles-for owl -->

			<!-- start content_slider -->
			<div class="line1">

			</div>
			<div id="example1">
				<div id="owl-demo" class="owl-carousel text-center">
					<?php 
			include("models/m_categories.php");
			$m_cate = new M_Category();
					$cates = $m_cate->read_top_view_cate();
					foreach($cates as $c):
						$parent_name = '';
						if($c->parent_id != 0) {
							$parent = $m_cate->read_cate_by_id($c->parent_id);
							$parent_name = $parent->name . " - ";
						}
						?>
						<div class="item">
							<a href="products.php?cate_id=<?php echo $c->id?>" title="image" rel="title1">
								<img class="img-responsive " src="admin/public/images/<?php echo $c->image?>" alt="">
								<div class="run">
									<p><?php echo $parent_name?> <?php echo $c->cate_name?></p>
								</div>
							</a>
						</div>
					<?php endforeach?>

				</div>
			</div>
			<h6 class="your-in">Your sport</h6>
			<div class="line2">

			</div>
		</div>
		<!--//sreen-gallery-cursual---->

		<h3 style="text-align: center; margin-top:50px; font-size: 35px ">Top products</h3>
		<div class="content-grids">
			<?php foreach($products as $p):
				$front = "$";
            	$back = "";
				$price = $p->price;
				if(isset($_SESSION["vn"])) {
					$front = "";
					$back = " vnd";
					$price = $p->price*$_SESSION["vn"];
				}
			?>
				<div class="col-md-4 content-grid">
					<a href="single.php?id=<?php echo $p->id?>" class="lot"><img class="img-responsive " src="admin/public/images/<?php echo $p->image?>" alt=""></a>
					<div class="shoe">
						<p><?php echo $p->name?></p>
						<label><?php echo $front?><?php echo number_format($price,2)?><?php echo $back?></label>
						<a href="single.php?id=<?php echo $p->id?>">find a store</a>
					</div>
					<div class="clearfix"> </div>
				</div>
			<?php endforeach?>
			
			

			<div class="clearfix"> </div>
		</div>
		<!---->
		<div class="content-top">
			<div class="col-md-4 top-content">
				<a href="single.html"><img class="img-responsive " src="public/images/pi.jpg" alt=""></a>
			</div>
			<div class="col-md-4 top-content">
				<a href="single.html"><img class="img-responsive " src="public/images/pi1.jpg" alt=""></a>
			</div>
			<div class="col-md-4 top-content">
				<a href="single.html"><img class="img-responsive " src="public/images/pi2.jpg" alt=""></a>
			</div>

			<div class="clearfix"> </div>
		</div>
		<div class="content-bottom">
			<div class="col-md-12 bottom-content">
				<script src="public/js/responsiveslides.min.js"></script>
				<script>
					$(function () {
						$("#slider").responsiveSlides({
							auto: true,
							speed: 500,
							namespace: "callbacks",
							pager: false,
							nav:true,
						});
					});
				</script>
				<div class="slider">
					<div class="callbacks_container">
						<ul class="rslides" id="slider">
							<li>
								<img src="public/images/vi.jpg" alt="">

							</li>
							<li>
								<img src="public/images/v2.jpg" alt="">
								
							</li>
							<li>
								<img src="public/images/vi.jpg" alt="">

							</li>
						</ul>
					</div>
					<div class="london">
						<h5>London Marathon 2013</h5>
						<p>24/2013 - 6Mins</p>
					</div>
				</div>

			</div>
			<!-- <div class="col-md-4 bottom-grid">
				<h4>Latest Sport News</h4>
				<div class="news">
					<span>25/07</span>
					<p>Sporting wonders have come so thick and fast since last summer that we decided it... time </p>
					<div class="foot">
						<label>football</label>
						<ul class="eye ">
							<li><span><i> </i>315</span></li>
							<li><a href="#"><i class="comment"> </i> 3</a></li>
						</ul>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="news">
					<span>25/07</span>
					<p>Sporting wonders have come so thick and fast since last summer that we decided it... time </p>
					<div class="foot">
						<label>football</label>
						<ul class="eye ">
							<li><span><i> </i>315</span></li>
							<li><a href="#"><i class="comment"> </i> 3</a></li>
						</ul>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="news">	
					<span>25/07</span>
					<p>Sporting wonders have come so thick and fast since last summer that we decided it... time </p>
					<div class="foot">
						<label>football</label>
						<ul class="eye ">
							<li><span><i> </i>315</span></li>
							<li><a href="#"><i class="comment"> </i> 3</a></li>
						</ul>
						<div class="clearfix"> </div>
					</div>
				</div>
				<a href="#" class="view">view all articles</a>
			</div> -->
			<div class="clearfix"> </div>
		</div>
	</div>	