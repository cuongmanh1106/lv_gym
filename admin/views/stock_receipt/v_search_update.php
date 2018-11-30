 <?php


 $size = json_decode($product->size);
 $quantity = $product->quantity;
 if($product->status == 0 ) {
    $detail = $m_stock->read_detail_by_stock_product($stock_id,$pro_id);
    $detail_size = json_decode($detail->size);
    if(count($detail_size) > 0 && count($size) > 0) {

        foreach($detail_size as $key=>$value) {
            if(isset($size->$key)) {
                $size->$key += $value;
            } else {
                $size->$key = $value;
            }
            $quantity += $value;
        }
    } else {
        $quantity += $detail->quantity;
    }
 }
 $show_size = "";
 if(count($size) > 0) {
    $show_size .= "( ";
    foreach($size as $key=>$s) {
        $show_size .= $key ."=>" . $s ." ";
    }
    $show_size .= " )";
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
                            <!-- <div class="row form-group">
                                <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>
                                <div class="col-md-4">
                                    <select name="size[]" class="form-control" id="select">
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                    </select>
                                </div>
                                <div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>
                                <div class="col-md-4"><input type="text" required="required" onkeyup="formatNumBerKeyUp(this)" id="text-input" name="quantity[]" class="form-control"></div>
                                <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> -->


                        </div>