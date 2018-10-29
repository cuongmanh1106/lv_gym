                        <table id="bootstrap-data-table" class="table table-striped table-bordered table_ship">
                            <thead>

                                <tr>
                                    <th>STT</th>
                                    <th>Order </th>
                                    <th>Shipper</th>
                                    <th>Total Order</th>
                                    <th>Addess</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($ship as $key=>$p):
                                    $user = $m_user->read_user_by_id($p->user_id);
                                    $user_name = $user->first_name .' '. $user->last_name;
                                    $order =  $m_order->read_order_by_id($p->order_id); 
                                    $order_detail = $m_order->read_detail_by_id($p->order_id); 
                                    $total = $order->delivery_cost;
                                    foreach($order_detail as $or) {
                                        $total += $or->price * $or->quantity;
                                    }
                                    ?>
                                    <tr id="">
                                        <input type="hidden" name="status_tmp" value="<?php echo $p->status?>">
                                        <input type="hidden" name="id" value="<?php echo  $p->id ?>">
                                        <input type="hidden" name="order_id" value="<?php echo  $p->order_id ?>">
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $p->order_id ?></td>
                                        <td><?php echo $user_name ?></td>
                                        <td>$<?php echo number_format($total,2) ?></td>
                                        <td><?php echo $order->delivery_place ?></td>
                                        <td width="15%" class="update_status">
                                            <?php
                                            if($p->status == 0)
                                                echo "Delivering";
                                            else if($p->status == 1) 
                                                echo "Delivered";
                                            else echo "Cancel"
                                                ?>
                                        </td>
                                        <td>
                                            <?php if($p->status == 1 || $p->status == 2 || $m_per->check_permission('edit_ship') == 0 ) {?>
                                            <button  disabled="" class="badge badge-default"><i class="fa fa-edit"></i> <span class="text_status">Change status</span></button>
                                            <?php } else { ?>  
                                            <button class="badge badge-danger change_status"><i class="fa fa-edit"></i> <span class="text_status">Change status</span></button>
                                            <?php } ?>

                                            <?php if($m_per->check_permission('edit_order')) {?>
                                            <a class=" btn  badge badge-success" href="order_detail.php?id=<?php echo $p->order_id?>"><i class="fa fa-eye"></i> View order</a>
                                            <?php } else {?>
                                            <button class="badge badge-default" disabled=""><i class="fa fa-eye"></i> View order</button>
                                            <?php }?>
                                      
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>