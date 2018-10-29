<input type="hidden" value="<?php echo (!isset($cate_id))?'':$cate_id ?>" name="cate_id">
<div class="product-grids" style="margin-top: 100px;">
	<!-- @include('admin.include.report'); -->
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				Soft by: <select name="soft" class="form-control">
					<option value="all">All</option>
					<option value="price_high">Price(High to low)</option>
					<option value="price_low">Price(Low to high)</option>
					<option value="popular">Most Popular</option>
					<option value="newest">Newest</option>
				</select>
			</div>
			<div class="col-md-4">
				Name: <input type="text" class="form-control" placeholder="name" name="name">
			</div>
          <!--   <div class="col-md-3">
                Discount: <select name="discount" class="form-control" >
                    <option value="all">All</option>
                    <option value="small,10"> < 10% </option>
                    <option value="10-20"> 10% - 20%</option>
                    <option value="20-30"> 20% - 30%</option>
                    <option value="30-50"> 30% - 50%</option>
                    <option value="big,50"> 50%</option>
                </select>
            </div> -->
            <div class="col-md-4">
            	Price: <select name="price" class="form-control">
            		<option value="all">All</option>
            		<option value="small,10"> < $10 </option>
            		<option value="10-30"> $10 - $30</option>
            		<option value="30-50"> $30 - $50</option>
            		<option value="50-100"> $50 - $100</option>
            		<option value="big,100"> >$100</option>
            	</select>
            </div>
        </div>
        <hr style="border:0.5px solid black">
    </div>

    <div class="container" id="fil_pro">

    	<?php $dem =0;
    	$count = 0;
    	foreach($products as $p) :
    		if($dem == 0) {
    			echo '<div class="product-top">';
    		}
    		?>


    		<div class="col-md-4 grid-product-in">  
    			<div class=" product-grid"> 
    				<a href="single.php?id=<?php echo $p->id?>"><img class="img-responsive " src="admin/public/images/<?php echo $p->image?>" alt=""></a>        
    				<div class="shoe-in">
    					<h6><a href="single.php?id=<?php echo $p->id?>"><?php echo $p->name ?> </a></h6>
    					<label>$<?php echo $p->price ?></label>
    					<a href="single.php?id=<?php echo $p->id?>" class="store"> FIND A STORE</a>
    					<button data-index = "<?php echo $p->id ?>" class="btn btn-primary add-cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
    				</div>

    				<b class="plus-on">+</b>
    			</div>  
    		</div>
    		<?php $dem++; ?>
    		<?php if($dem==3): 
    		$dem = 0;
    		?>

    		<div class="clearfix"> </div>
    	</div>  
    <?php endif;?>

    <?php $count++ ?>
<?php endforeach?>
<div class="clearfix"></div>

<div class=" col-md-3  col-md-offset-4" style="margin: auto; text-align: center; float: right;">
	<ul class="pagination modal-1">
		<?php
		if($current_page == 1) {
			?>
			<li><a class="prev">&laquo</a></li>
			<?php
		} else {
			?>
			<li><a href="products.php?pages=<?php echo $current_page- 1?>&cate_id=<?php echo $cate_id?>" class="prev">&laquo</a></li>
			<?php
		}
		?>
		<?php
		for($i = 1 ; $i<=$total_page ; $i++)
		{
			$active = '';
			if($current_page == $i) 
			{
				$active = 'active';

				?>
				<li> <a class="<?php echo $active?>" ><?php echo $i?></a></li>
				<?php
			} else {
				?>
				<li> <a class="<?php echo $active?>" href="products.php?pages=<?php echo $i?>&cate_id=<?php echo $cate_id?>"><?php echo $i ?></a></li>
				<?php }}?>

				<?php
				if($current_page == $total_page) {
					?>
					<li><a class="prev">&raquo</a></li>
					<?php
				} else {
					?>
					<li><a href="products.php?pages=<?php echo $current_page+ 1?>&cate_id=<?php echo $cate_id?>	" class="prev">&raquo</a></li>
					<?php
				}
				?>
			</ul>
		</div>

		<!-- {{ isset($check_search)?'':$products->links() }} -->

	</div>
</div>
</div>
<script type="text/javascript">
	$(document).on('change','select[name=price], select[name=soft], input[name=name]',function(){
		var price = $('select[name=price]').val();
        // var discount = $('select[name=discount]').val();
        var soft = $('select[name=soft]').val();
        var name = $('input[name=name]').val();
        var cate_id = $('input[name=cate_id]').val();

        $.ajax({
        	type:'POST',
        	url: "ajax.php",
        	data: {'price':price,'soft':soft,'name':name,'cate_id':cate_id,'frontend_search_product':'OK'},
        	success:function(data) {
        		$('#fil_pro').html(data);
        	}
        })
    })

	$(document).on('keyup','input[name=name]',function(){
		var price = $('select[name=price]').val();
        // var discount = $('select[name=discount]').val();
        var soft = $('select[name=soft]').val();
        var name = $('input[name=name]').val();
        var cate_id = $('input[name=cate_id]').val();

        $.ajax({
        	type:'POST',
        	url: "ajax.php",
        	data: {'price':price,'soft':soft,'name':name,'cate_id':cate_id,'frontend_search_product':'OK'},
        	success:function(data) {
        		$('#fil_pro').html(data);
        	}
        })

    })
</script>