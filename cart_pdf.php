<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>asdasd</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="admin/public/assets/css/font-awesome.min.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="public/js/jquery.min.js"></script>


    <!-- Custom Theme files -->
    <!--theme-style-->
    <link href="public/css/style.css" rel="stylesheet" type="text/css" media="all" />   
    <!--//theme-style-->
    
    <!--fonts-->
    <!--//fonts-->

    <style type="text/css">

    .detail {
        width: 100%;
        border: 1px solid red;
    } 
    .tb-col {
        margin-right: 100px;
        padding-right: 70px;
    }   
    </style>
</head>
<body>
   
    <?php 
    include("models/m_order.php");
    include("models/m_products.php");
    $m_order = new M_order();
    $m_pro = new M_products();

    $order = $m_order->read_order_by_id($id);
    
    $c_tmp = $m_order->read_detail_by_order($id);
    $total_order = 0;
    ?>

    <div class="container">
        <div class="panel panel-info" style="margin-top: 150px">
            <div class="panel-heading"><h3 style="text-align: center;color: red">Order Details</h3></div>
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
                    <div class="col-md-4">
                        <h4><b>Delivery cost:</b> <span id="delivery_cost"><?php echo  $order->delivery_place  ?></span></h4>
                    </div>
                    <div class="col-md-4">
                        <h4><b>Delivery cost:</b> $<span id="delivery_cost"><?php echo  $order->delivery_cost  ?></span></h4>
                    </div>
                    <div class="col-md-4">
                        <h4><b>Sub total:</b> $<span class="total"><?php echo $_SESSION["total"] ?></span></h4>
                    </div>

                </div>


        </form>

        <div class="clearfix"></div>
        <hr style="border:0.5px solid #000">
        <table border="0" width="100%"  style="width: 100px;" id="table_detail" class="detail">
            <thead>
                <tr>
                    <th class="tb-col">image</th>
                    <th class="tb-col">Name</th>
                    <th class="tb-col">Price</th>
                    <th class="tb-col">Quantity</th>
                    <th class="tb-col">Size</th>
                    <th class="tb-col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
             <?php 
             foreach($c_tmp as $c){
                $product = $m_pro->read_product_by_id($c->pro_id);
                $sizes = json_decode($product->size);
                ?>
                <tr>
                   <td><img src="admin/public/images/<?php echo $product->image?>" style="width: 70px;" /></td>
                   <td><?php echo  $product->name  ?></td>
                   <td>$ <?php echo  number_format($c->price, 2) ?></td>
                   <td width="10%"><?php echo  $c->quantity  ?></td>
                   <td><?php echo $c->size ?></td>
                   <td>$ <span class="sub-total"><?php echo  number_format($c->price*$c->quantity,2) ?></span></td>
               </tr>
           <?php } ?>
       </tbody>
   </table>
    </div>

</div>
</div>



</body>
</html>




