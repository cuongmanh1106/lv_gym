 <?php


 $size = json_decode($product->size);
 $quantity = $product->quantity;
 $show_size = "";
 if(count($size) > 0) {
    $show_size .= "( ";
    foreach($size as $key=>$s) {
        $show_size .= $key ."=>" . $s ." ";
    }
    $show_size .= " )";
}
 if($product->status == 0 ) { // show update quantity
    $detail = $m_stock->read_detail_by_stock_product($stock_id,$pro_id);
    $detail_size = json_decode($detail->size);
    $show_size .= '<span style="color:red"> [ + '.(isset($detail->quantity)?$detail->quantity:0) .' ] </span>';
}



?>
<input type="hidden" name="pro_id" value="<?php echo $product->id?>">
<div class="">
    <div class="col-md-3">
        <img src="public/images/<?php echo $product->image?>" alt="">
    </div>
    <div class="col-md-6">
        <div class="col-md-4">
            <p><b>Product Name:</b></p>
        </div>
        <div class="col-md-8">
            <p><?php echo $product->name ?></p>
        </div>
        
        <div class="col-md-4">
            <p><b>Price in:</b></p>
        </div>
        <div class="col-md-8">
            <p>$ <?php echo $product->price_in?></p>
        </div>
        <div class="col-md-4">
            <p><b>Price out:</b></p>
        </div>
        <div class="col-md-8">
            <p>$ <?php echo $product->price ?></p>
        </div>
        <div class="col-md-4">
            <p><b>Quantity:</b></p>
        </div>
        <div class="col-md-8">
            <p><?php echo $quantity?> <?php echo $show_size ?>
            </p>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<br>
<?php if($product->status == 2) {?> <!-- sản phẩm mới thêm vào chưa được bán -->
<div class="col-md-6">
    <b>Price In:</b><input class="form-control" onkeyup="formatNumBerKeyUp(this)" type="text" name="price_in" value="<?php echo $product->price_in?>" >
</div>

<div class="col-md-6">
    <b>Price Out:</b><input class="form-control" onkeyup="formatNumBerKeyUp(this)" type="text" name="price" value="<?php echo $product->price?>" >
</div>
<?php } ?>
<div class="col-md-12"><b>Extra quantity:</b><input class="form-control" <?php echo ($size == "")?"":"readonly"?> type="text" name="total_quantity" value="0" onkeypress="return isNumberKey(event)" ></div>

<div class="clearfix"></div>
<hr>

<a href="javascript::void(0)" class="btn btn-secondary <?php echo ($size == "")?"disabled":"" ?>" id="add-sub-size"><i class="fa fa-plus"></i> Add size</a>
<br><br>
<div id="add-size">
 
</div>