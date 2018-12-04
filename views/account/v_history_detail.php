

<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Your order detail infomation</h3></div>
        <div class="panel-body">
            

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
                $total = 0;
                $front = "$";
                $back = "";
                if(isset($_SESSION["vn"])) {
                    $front = "";
                    $back = " VND"; 
                } 
                foreach($details as $c): 
                $product = $m_pro->read_product_by_id($c->pro_id);
                $price = $c->price;
                if(isset($_SESSION["vn"])) {
                    $price = $c->price*$_SESSION["vn"];
                }
                $total += $price*$c->quantity;
                ?>
                <tr>
                    <td><img src="admin/public/images/<?php echo  $product->image ?>" width="70px"></td>
                    <td><?php echo  $product->name  ?></td>
                    <td><?php echo $front?> <?php echo  number_format($price, 2) ?><?php echo $back?></td>
                    <td width="10%"><?php echo  $c->quantity  ?></td>
                    <td><?php echo $c->size ?></td>
                    <td><?php echo $front?> <span class="sub-total"><?php echo number_format($price*$c->quantity,2) ?></span><?php echo $back?></td>

                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <td colspan="7" align="right"><h2><b>Total: </b> <?php echo $front?><span class="total"><?php echo number_format($total,2) ?></span><?php echo $back?></h2></td>
            </tfoot>

        </table>
        <a class="btn btn-danger" href="profile_order.php"><i class="fa fa-reply"></i> Back</a>
        <a class="btn btn-success" href="load_cart_pdf?id=<?php echo $id?>"><i class="fa fa-file-text-o"></i> Export PDF</a>
    </div>
</div>
</div>




