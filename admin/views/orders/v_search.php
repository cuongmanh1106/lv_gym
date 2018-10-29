<table id="bootstrap-data-table" class="table table-striped table-bordered table_order search_order">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Order Number</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>Delivery cost</th>
                  <th>Sub total</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
              </thead>

              <tbody>
                
                <?php 
                foreach($orders as $key=>$c):
                $order_detail = $m_order->read_detail_by_id($c->id);
                $subtotal = 0;
                $customer = $m_user->read_user_by_id($c->customer_id); 
                foreach($order_detail as $o) {
                  $subtotal += $o->price*$o->quantity;
                }
                $status = $m_order->read_status_by_id($c->status); 
                ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo $c->id ?></td>
                  <td><?php echo $c->created_at ?></td>
                  <td><?php echo $customer->first_name ?> <?php echo $customer->last_name ?></td>
                  <td><?php echo $c->delivery_cost ?></td>
                  <td>$ <?php echo number_format($subtotal, 2)?></td>
                  <td>$ <?php echo number_format($subtotal + $c->delivery_cost, 2)?></td>
                  <td><?php echo $status->name ?></td>
                  
                  <td>
                    <?php if($m_per->check_permission('edit_order') ==1) {?>
                    <a class="badge badge-info" href="order_detail.php?id=<?php echo $c->id?>"><i class="fa fa-edit"></i> View Details</a>
                    <?php } else {?>
                    <button type="button" class="badge badge-default" disabled><i class="fa fa-edit"></i> View Details</button>
                    <?php }?>
                  </td>

                </tr>
                <?php endforeach ?>

              </tbody>
            </table>