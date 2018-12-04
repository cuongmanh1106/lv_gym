<script>
// $(window).on('load', function(){
//     window.location
// });

$(document).ready(function() {
    // if(location.reload()) {
    //     window.location = 'products.php';
    // }

    // $(window).on('beforeunload', function(){
     
    // }); window.location = '.';
});
</script>
<?php 
$front = "$";
$back = "";
if(isset($_SESSION["vn"])) {
  $front = "";
  $back = " VND"; 
  
} 


?>
<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Order successfully</h3></div>
        <div class="panel-body">
            <form method="POST" action="">
                <div class="row" style="padding: 30px 0 0 0 ">

                 <div class="col-md-4">
                    <h4><b>Date: </b><span><?php echo  date("d/m/Y") ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Customer: </b><span><?php echo $_SESSION["customer"]->first_name?> <?php echo  $_SESSION["customer"]->last_name ?></span></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Phone number: </b><span><?php echo $_SESSION["customer"]->phone_number?></span></h4>
                </div>
            </div>
            <div class="row" style="padding: 30px 0 0 0">
                <div class="col-md-1"><h4><b>Address:</b></h4></div>
                <div class="col-md-3">
                    <?php echo  $order->delivery_place ?>
                </div>
                <div class="col-md-4">
                    <h4><b>Delivery cost:</b> <?php echo $front?><span id="delivery_cost"><?php echo  number_format($order->delivery_cost*(isset($_SESSION["vn"])?$_SESSION["vn"]:1),2)  ?></span><?php echo $back?></h4>
                </div>
                <div class="col-md-4">
                    <h4><b>Sub total:</b> <?php echo $front?><span class="total"><?php echo number_format($total_order,2) ?></span><?php echo $back?></h4>
                </div>
                
            </div>

            
            
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

                    $price = $c["price"];
                    if(isset($_SESSION["vn"])) {
                     
                      $price = $c["price"]*$_SESSION["vn"];
                      
                    } 

                    ?>
                    <tr>
                        <td><img src="admin/public/images/<?php echo $product->image ?>" width="70px"></td>
                        <td><?php echo  $product->name  ?></td>
                        <td><?php echo $front?> <?php echo  number_format($price, 2) ?><?php echo $end?></td>
                        <td width="10%"><?php echo  $c["qty"]  ?></td>
                        <td><?php echo $c["size"] ?></td>
                        <td><?php echo $front?> <span class="sub-total"><?php echo  number_format($price*$c["qty"],2) ?></span><?php echo $back?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>

                <td colspan="7" align="right"><a href="." class="btn btn-success"><i class="fa fa-reply"></i> Back</a></td>
            </tfoot>
        </table>
    </div>

</div>
</div>

<?php 
unset($_SESSION["cart"]);
?>