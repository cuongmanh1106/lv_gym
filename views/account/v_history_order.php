
<div class="container">
    <div class="panel panel-info" style="margin-top: 150px">
        <div class="panel-heading"><h3 style="text-align: center;">Your History cart</h3></div>
        <div class="panel-body">
            

        <table id="table_order" class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Delivery cost</th>
                    <th>Sub total</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php 
                foreach($orders as $c):
                $order_detail = $m_order->read_detail_by_order($c->id);
                $subtotal = 0;

                foreach($order_detail as $o) {
                	$subtotal += $o->price*$o->quantity;
                }
                $status_name = '';
                $status = $m_order->read_status_by_id($c->status); 
                if($status != null) {
                    $status_name = $status->name;
                }




                
                ?>
                <tr>
                	<td><?php echo $c->created_at  ?></td>
                    <td><?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($c->created_at))->diffForHumans() ?></td>
                    <td><?php echo $c->delivery_cost  ?></td>
                    <td>$ <?php echo  number_format($subtotal, 2) ?></td>
                    <td>$ <?php echo  number_format($subtotal + $c->delivery_cost, 2)?></td>
                    <td><?php echo  $status_name ?></td>
                    <td><a class="btn btn-info" href="profile_detail?id=<?php echo $c->id?>"><i class="fa fa-edit"></i> View Details</a></td>

                </tr>
                <?php endforeach ?>
                <tfoot>
                	<td><a class="btn btn-danger" href="profile.php"><i class="fa fa-reply"></i> Profile</a></td>
                </tfoot>
            </tbody>
           
        </table>
    </div>
</div>
</div>

<script>
    $(document).ready( function () {
    $('#table_order').DataTable();
} );
    
</script>

