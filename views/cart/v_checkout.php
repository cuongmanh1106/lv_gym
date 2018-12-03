<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Your cart infomation</h3></div>
        <div class="panel-body">
            <form method="POST" action="cart_success.php">
                <div class="row" style="padding: 30px 0 0 0 ">

                 <div class="col-md-4">
                    <h4><b>Date: </b><span><?php echo date("d/m/Y") ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Customer: </b><span><?php echo $_SESSION["customer"]->first_name?> <?php echo $_SESSION["customer"]->last_name ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Phone number: </b><span><?php echo $_SESSION["customer"]->phone_number?></span></h4>
                </div>
            </div>
            <div class="row" style="padding: 50px 0 30px 0">
                <div class="col-md-1">
                    <h4><b>Delivery to: </b></h4>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="destination">
                        <option value="hcm">Tp. Hồ Chí Minh</option>
                        <option value="other">Other </option>
                    </select>
                </div>
                <div class="col-md-1"><h4><b>Specific:</b></h4></div>
                <div class="col-md-3">
                    <input type="text" required="" class="form-control" name="specific" value="<?php echo $_SESSION["customer"]->address ?>" placeholder=" Specific address">
                </div>
                <div class="col-md-4">
                    <h4><b>Delivery cost:</b> $<span id="delivery_cost">2.00</span></h4>
                </div>


                <div class="col-md-1">
                    <h4><b>Payment: </b></h4>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="payment">
                        <option value="cash">Cash</option>
                        <option value="paypal">Paypal </option>
                    </select>
                </div>
            </div>
           
           
            <button type="button" name="order" class="btn btn-success" style="float: right;margin-right: 15px"><i class="fa fa-shopping-cart"></i> Order </button> 
             <a class="btn btn-danger" href="products.php"  style="float: right;"><i class="fa fa-reply"></i> Continue to buy</a>
        </form>
        <div class="clearfix"></div>
        <hr style="border:0.5px solid #000">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Subtotal</th>

                </tr>
            </thead>

            <tbody>
                <?php 
                foreach($carts as $c):
                $product = $m_pro->read_product_by_id($c["id"]);
                $sizes = json_decode($product->size);
                $qty = $c["qty"];
                
                ?>
                <tr>
                    <td><img src="admin/public/images/<?php echo $product->image ?>" width="70px"></td>
                    <td><?php echo  $product->name  ?></td>
                    <td>$ <?php echo  number_format($c["price"], 2) ?></td>
                    <td width="10%"><?php echo  $qty  ?></td>
                    <td><?php echo $c["size"] ?></td>
                    <td>$ <span class="sub-total"><?php echo number_format($c["price"]*$c["qty"],2) ?></span></td>

                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <td colspan="7" align="right"><h2><b>Total: </b> $<span class="total"><?php echo $total ?></span></h2></td>
            </tfoot>
        </table>
    </div>
</div>
</div>


<script type="text/javascript">
    $('select[name=destination]').on('click',function(){
        v = $('select[name=destination').val();
        if(v == 'hcm') {
            $('#delivery_cost').html('2.00')
        } else {
            $('#delivery_cost').html('4.00')
        }
    })

    $('button[name=order]').on('click',function(){
        if($('input[name=specific]').val() == "") {
            alert('your specific address can not be null');
        } else {
            $('button[name=order]').attr('type','submit');
        }
    })
</script>