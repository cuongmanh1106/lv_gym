<input type="hidden" value="<?php echo (!isset($cate_id))?'':$cate_id ?>" name="cate_id">
<div class="product-grids" style="margin-top: 100px; padding: 0">
	<!-- @include('admin.include.report'); -->

    <div class="container" id="fil_pro">

    	<?php $dem =0;
    	$count = 0;
    	foreach($products as $p) :
    		if($dem == 0) {
    			echo '<div class="product-top">';
    		}
            $promotion_price = $p->price_sale;
            
            $price = $p->price_out;
            $front = "$";
            $back = "";
            if(isset($_SESSION["vn"])) {
                $front = "";
                $back = " VND"; 
                $price = $p->price_out*$_SESSION["vn"];
                $promotion_price = $p->price_sale*$_SESSION["vn"];
            } 
            ?>
            <div class="col-md-4 grid-product-in">  
             <div class=" product-grid"> 
                <a href="single.php?id=<?php echo $p->id?>"><img class="img-responsive " src="admin/public/images/<?php echo $p->image?>" alt=""></a>        
                <div class="shoe-in">
                   <h6><a href="single.php?id=<?php echo $p->id?>"><?php echo $p->name ?> </a></h6>

                   <div class="row" style="padding-bottom: 15px; padding-top: 15px">
                    <div class="col-md-6"><strike><?php echo $front?><?php echo number_format($price,2) ?><?php echo $back?></strike></div>
                    <div class="col-md-6" style="text-align: right; color:#ff4d4d"><h4 id="price_<?php echo $p->id?>" data-price="<?php echo $p->price_sale?>"><b><?php echo $front?><?php echo number_format($promotion_price,1) ?><?php echo $back?></b></h4></div>
                </div>
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
=======
<input type="hidden" value="<?php echo (!isset($cate_id))?'':$cate_id ?>" name="cate_id">
<div class="product-grids" style="margin-top: 100px;">
	<!-- @include('admin.include.report'); -->

    <div class="container" id="fil_pro">

    	<?php $dem =0;
    	$count = 0;
    	foreach($products as $p) :
    		if($dem == 0) {
    			echo '<div class="product-top">';
    		}
            $promotion_price = $p->price_sale;
            
            $price = $p->price_out;
            $front = "$";
            $back = "";
            if(isset($_SESSION["vn"])) {
                $front = "";
                $back = " VND"; 
                $price = $p->price_out*$_SESSION["vn"];
                $promotion_price = $p->price_sale*$_SESSION["vn"];
            } 
            ?>
            <div class="col-md-4 grid-product-in">  
             <div class=" product-grid"> 
                <a href="single.php?id=<?php echo $p->id?>"><img class="img-responsive " src="admin/public/images/<?php echo $p->image?>" alt=""></a>        
                <div class="shoe-in">
                   <h6><a href="single.php?id=<?php echo $p->id?>"><?php echo $p->name ?> </a></h6>

                   <div class="row" style="padding-bottom: 15px; padding-top: 15px">
                    <div class="col-md-6"><strike><?php echo $front?><?php echo number_format($price,2) ?><?php echo $back?></strike></div>
                    <div class="col-md-6" style="text-align: right; color:#ff4d4d"><h4 id="price_<?php echo $p->id?>" data-price="<?php echo $p->price_sale?>"><b><?php echo $front?><?php echo number_format($promotion_price,1) ?><?php echo $back?></b></h4></div>
                </div>
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
