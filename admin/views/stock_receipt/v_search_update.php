 <?php
 $size = "";
 if(count(json_decode($product->size))>0) {
    $size .= "( ";
    foreach(json_decode($product->size) as $key=>$s) {
        $size .= $key ."=>" . $s ." ";
    }
    $size .= " )";
 }

 ?>
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
                            <p>Supplier</p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Price out:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $product->price ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Quantity:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $product->quantity?> <?php echo $size ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                
                <div class="col-md-12"><b>Total quantity:</b><input class="form-control" type="text" name="total_quantity" value="0" onkeypress="return isNumberKey(event)" ></div>

                <div class="clearfix"></div>
                <hr>
                <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-size"><i class="fa fa-plus"></i> Add size</a>
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