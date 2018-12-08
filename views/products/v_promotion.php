<input type="hidden" value="<?php echo (!isset($cate_id))?'':$cate_id ?>" name="cate_id">
<div class="product-grids" style="margin-top: 100px;">
    <!-- @include('admin.include.report'); -->
 
    <div class="container" id="fil_pro">
    <h3 style="text-align: center;"><b>Promotion Products</b></h3>
        <?php $dem =0;
        $count = 0;
        foreach($products as $p) :
            if($dem == 0) {
                echo '<div class="product-top">';

            }
            $promotion_price = 0;
            $promotion = $m_promotion->get_promotion_price($p->id);
            if($promotion != 0) {
                $promotion_price = $promotion->price;
            }   
            $price = $p->price;
            $front = "$";
            $back = "";
            if(isset($_SESSION["vn"])) {
                $front = "";
                $back = " VND"; 
                $price = $p->price*$_SESSION["vn"];
                if($promotion != 0) {
                    $promotion_price = $promotion->price*$_SESSION["vn"];
                }
            } 
            ?>


            <div class="col-md-4 grid-product-in">  
                <div class=" product-grid"> 
                    <a href="single.php?id=<?php echo $p->id?>"><img class="img-responsive " src="admin/public/images/<?php echo $p->image?>" alt=""></a>        
                    <div class="shoe-in">
                        <h6><a href="single.php?id=<?php echo $p->id?>"><?php echo $p->name ?> </a></h6>
                        <?php if($promotion_price == 0) {?>
                        <h4  id="price_<?php echo $p->id?>" data-price="<?php echo $p->price ?>" style="padding-bottom: 15px; padding-top: 15px"><b><?php echo $front?><?php echo number_format($price,1) ?><?php echo $back?></b></h4>
                        <?php } else {?>
                        <div class="row" style="padding-bottom: 15px; padding-top: 15px">
                            <div class="col-md-6"><strike><?php echo $front?><?php echo number_format($price,2) ?><?php echo $back?></strike></div>
                            <div class="col-md-6" style="text-align: right; color:#ff4d4d"><h4 id="price_<?php echo $p->id?>" data-price="<?php echo $promotion->price?>"><b><?php echo $front?><?php echo number_format($promotion_price,1) ?><?php echo $back?></b></h4></div>
                        </div>


                        <?php }?>
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