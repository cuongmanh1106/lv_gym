<div class="col-md-6">Total quantity<input class="form-control" type="text" name="total_quantity" value="<?php echo $product->quantity ?>" onkeypress="return isNumberKey(event)" ></div>

                    <div class="clearfix"></div>
                    <hr>
                    <div id="add-size">
                        <?php 
                        if(count($sizes) != 0) {
                            foreach($sizes as $key=>$value){
                                ?>

                                <div class="row form-group">
                                    <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>
                                    <div class="col-md-4">
                                        <select name="size[]" class="form-control" id="select">
                                            <option <?php echo  ($key=="XS")?'selected':'' ?> value="XS">XS</option>
                                            <option <?php echo ($key=="S")?'selected':''  ?> value="S">S</option>
                                            <option <?php echo ($key=="M")?'selected':''  ?> value="M">M</option>
                                            <option <?php echo ($key=="L")?'selected':''  ?> value="L">L</option>
                                            <option <?php echo ($key=="XL")?'selected':''  ?> value="XL">XL</option>
                                            <option <?php echo ($key=="2XL")?'selected':''  ?> value="2XL">2XL</option>
                                            <option <?php echo ($key=="3XL")?'selected':''  ?> value="3XL">3XL</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>
                                    <div class="col-md-4"><input type="text" value="<?php echo  $value ?>" required="required" onkeypress="return isNumberKey(event)" id="text-input" name="quantity[]" class="form-control"></div>
                                    <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php }}?>


                            </div>
                            <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-size"><i class="fa fa-plus"></i> Add sub size</a>
