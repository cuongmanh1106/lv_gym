

<?php include("include/report.php"); ?>
<div class="breadcrumbs">

    <div class="page-header">
        <div class="page-title">
            <ol class="breadcrumb text-right">
                <li><a href="orders_list.php" style="color:blue">Orders</a></li>
                <li class="active">Detail order</li>
            </ol>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header badge-success">
                        <strong class="card-title"><i class="fa fa-pencil"></i> Detail order</strong>
                    </div>
                    <?php
                    $customer = $m_user->read_user_by_id($order->customer_id);
                    ?>
                    <div class="card-body">
                        <div>
                           <div class="col-md-12">
                            <div class="card">
                                <div class="card-header badge-info">
                                    <strong class="card-title"><i class="fa fa-info-circle"></i> Customer infomation</strong>
                                </div>

                                <div class="card-body">
                                    <form method="post"  action="">
                                        <div class="row">
                                            <div class="col-md-4"><b>Date: </b>  <?php echo $order->created_at?> </div>
                                            <div class="col-md-4"><b>Customer: </b>  <?php echo $customer->first_name?> <?php echo $customer->last_name ?> </div>
                                            <div class="col-md-4"><b>Phone: </b> <?php echo  $customer->phone_number ?></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <?php if($order->status == 1 && $_SESSION["user"]->permission_id != 6) {?>
                                            <div class="col-md-4">
                                                <b>Delivery to: </b><input type="text" class="form-control" name="delivery_place" value="<?php echo  $order->delivery_place ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <b>Delivery cost: </b><input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="delivery_cost" value="<?php echo  $order->delivery_cost ?>">
                                            </div>
                                            <?php } else {?> 
                                            <div class="col-md-4">
                                                <b>Delivery to: </b><?php echo $order->delivery_place ?>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Delivery cost: </b><?php echo $order->delivery_cost ?>
                                            </div>
                                            <?php }?>
                                            <div class="col-md-4">
                                                <b>Status: </b>
                                                <?php if($order->status < 4 && $_SESSION["user"]->permission_id!=6) { ?> <!--không cho sửa delivery-->
                                                <select class="form-control" name="status">
                                                    <?php
                                                    foreach($status as $stt):
                                                        $selected = '';
                                                        $disabled = '';
                                                        if($stt->id == $order->status) {
                                                            $selected = 'selected';
                                                        }
                                                        if($stt->id < $order->status) {
                                                            $disabled = 'disabled';
                                                        }
                                                        ?>
                                                        <option <?php echo $disabled?> <?php echo $selected?> value="<?php echo  $stt->id ?>"><?php echo  $stt->name ?></option>
                                                    <?php endforeach?>
                                                </select>

                                                <?php
                                                    } else {//end if
                                                        $stt = $m_order->read_status_by_id($order->status);
                                                        echo $stt->name;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row" style="text-align: right">
                                                <a href="" class="btn btn-danger"><i class="fa fa-reply"></i> Back</a>
                                                <?php if($order->status == 3) {?> <!-- nếu cập nhật lại người giao hàng -->
                                                <Button type="button" class="btn btn-info" name="delivery_first" data-toggle="modal" data-target="#delivery"><i class="fa fa-thumbs-up"></i> Confirm</Button>
                                                <button type="submit" name="confirm" class="btn btn-info " style="display: none"><i class="fa fa-thumbs-up"></i> Confirm</button>
                                                <?php } elseif($order->status < 4) { ?> <!-- cập nhật status -->
                                                <Button type="submit" name="confirm" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Confirm</button>
                                                    <?php } else {?>  <!-- khi status là completed hoặc cancel thì không cho cập nhật lại nữa -->
                                                    <button disabled type="button" name="confirm" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Confirm</button>
                                                    <?php }?>
                                                    <Button type="button" class="btn btn-info hidden" name="delivery" data-toggle="modal" data-target="#delivery"><i class="fa fa-thumbs-up"></i> Confirm</Button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>



                                    <div class="card">
                                        <div class="card-header badge-info">
                                            <strong class="card-title"> <i class="fa fa-info-circle"></i> Order infomation</strong>
                                        </div>

                                        <div class="card-body">
                                         <table id="bootstrap-data-table" class="table table-striped table-bordered search_order">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Product name</th>
                                                    <th>Size</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 
                                                $total = 0;
                                                foreach($details as $dt):
                                                    $product = $m_product->read_product_by_id($dt->pro_id);
                                                    $subtotal = 0;
                                                    $total += $dt->price * $dt->quantity;
                                                    ?>
                                                    <tr>

                                                        <td width="20%"><img src="public/images/<?php echo $product->image?>" width="100px"></td>
                                                        <td><?php echo  $product->name ?></td>
                                                        <td><?php echo $dt->size?></td>
                                                        <td>$ <?php echo  number_format($dt->price,2)?></td>
                                                        <td><?php echo  $dt->quantity ?></td>
                                                        <td>$ <?php echo  number_format($dt->price*$dt->quantity,2)?></td>
                                                    </tr>
                                                <?php endforeach ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" align="right" style="font-size: 25px"><b>Total: $</b><?php echo number_format($total,2) ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <?php include('v_delivery.php') ?>;



    <script type="text/javascript">

        $('button[name=delivery]').hide();
        $('select[name=status]').on('change',function(){
            status = $('select[name=status]').val();
            console.log(status);

            if(parseInt(status) == 3) {
                $('button[name=confirm]').hide();
                $('button[name=delivery]').show();
            } else {
                $('button[name=confirm]').show();
                $('button[name=delivery]').hide();
                $('button[name=delivery_first]').hide();
            }
        }) 


    </script>
    <script type="text/javascript">
        $('#delivery').on('show.bs.modal', function(e) {
            delivery_place = $('input[name=delivery_place]').val();
            delivery_cost = $('input[name=delivery_cost]').val();
            $(e.currentTarget).find('input[name="delivery_place"]').val(delivery_place);
            $(e.currentTarget).find('input[name="delivery_cost"]').val(delivery_cost);
            id = '<?php echo $id?>';
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:{'id':id,'check_delivery':'OK'},
                success:function(data) {

                }

            })

        })
    </script>