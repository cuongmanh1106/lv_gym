
<!DOCTYPE html>
<html>
<head>
<title><?php echo (isset($title)?$title:'')?></title>
<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="admin/public/assets/css/font-awesome.min.css">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="public/js/jquery.min.js"></script>

<!-- Custom Theme files -->
<!--theme-style-->
<link href="public/css/style.css" rel="stylesheet" type="text/css" media="all" />   
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sport Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--//fonts-->
<script type="text/javascript" src="admin/public/assets/js/myscript.js" charset="utf-8" ></script>


<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Order successfully</h3></div>
        <div class="panel-body">
            <form method="POST" action="{{ route('frontend.cart.order') }}">
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
                    <h4><b>Delivery cost:</b> $<span id="delivery_cost"><?php echo  $order->delivery_cost  ?></span></h4>
                </div>
                 <div class="col-md-4">
                    <h4><b>Sub total:</b> $<span class="total"><?php echo $total_order ?></span></h4>
                </div>
               
            </div>

            <!-- <div class="row" style="padding: 30px 0 0 0">
                <div class="col-md-4 col-md-offset-8">
                    <h3 style="color:#4E72D0"><b>Total:</b> $<span class="total">{{$total + (int)str_replace(',','',$order->delivery_cost)}}</span></h3>
                </div>
            </div> -->
           
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
                ?>
                <tr>
                    <td><img src="admin/public/images/<?php echo $product->image ?>" width="70px"></td>
                    <td><?php echo  $product->name  ?></td>
                    <td>$ <?php echo  number_format($c["price"], 2) ?></td>
                    <td width="10%"><?php echo  $c["qty"]  ?></td>
                    <td><?php echo $c["size"] ?></td>
                    <td>$ <span class="sub-total"><?php echo  number_format($c["price"]*$c["qty"],2) ?></span></td>

                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <td colspan="7" align="right"><a href="." class="btn btn-info"><i class="fa fa-reply"></i> PDF</a></td>
                <td colspan="7" align="right"><a href="." class="btn btn-success"><i class="fa fa-reply"></i> Back</a></td>
            </tfoot>
        </table>
    </div>

</div>
</div>

</head>
<body> 

