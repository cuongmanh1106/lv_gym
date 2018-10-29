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