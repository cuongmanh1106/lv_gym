

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header badge-info">
                        <strong class="card-title"><i class="fa fa-truck"></i> Ship</strong>
                        
                    </div>
                    <?php if($_SESSION['user']->permission_id !=6) { ?>
                    <div class="search" style="margin-top: 20px">
                        <div class="col-md-4 col-md-offset-3">
                            Order:
                            <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="order" placeholder=" Order number...">
                        </div>
                        <div class="col-md-4 col-md-offset-3">
                            <?php
                            $shipper = $m_user->read_user_by_permission(6);
                            ?>
                            Shipper:
                            <select name="user_id" required="required" id="select" class="selected2 form-control" style="padding: 5px">
                                <option value="all">All</option>
                                <?php foreach($shipper as $sh): ?>
                                    <option value="<?php echo  $sh->id ?>"><?php echo $sh->first_name ?> <?php echo $sh->last_name ?></option>
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            Status:
                            <select name="status" required="required" class="selected2 form-control">
                                <option value="all">--All--</option>
                                <option value="0">Delivering</option>
                                <option value="1">Delivered</option>
                                <option value="2">Cancel</option>
                            </select>
                        </div>
                    </div>
                    <?php }?>
                    <div class="card-body search_ship">

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
                </div>
            </div>
        </div>


    </div>
</div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->




<script>

    $(document).on('click','.change_status',function(){
        status = $(this).parent().parent().find('input[name=status_tmp]').val();
        this1 = $(this);
        select0 = '';
        select1 = '';
        if(status == 0) select0 = 'selected';
        else if(status == 1) select1 = 'selected';
        if(status)
            html = '';
        html += '<select  class="form-control" name="update_status">';
        html += '<option '+select0+' value="0">Delivering</option>';
        html += '<option '+select1+' value="1">Delivered</option>';
        html += '<option value="2">Cancel</option>';
        $(this).parent().parent().find('.update_status').html(html) ;
        $(this).removeClass('change_status');
        $(this).addClass('update_stt');
        $(this).find('.text_status').html('Update');
    })

    $(document).on('click','.update_stt',function(){
        this1 = $(this).parent().parent();
        this2 = $(this);
        status = this1.find('select[name=update_status]').val();
        id = this1.find('input[name=id]').val();
        order_id = this1.find('input[name=order_id]').val();
        console.log(id+"-"+ order_id + "- "+status);
        $.ajax({
            type:'POST',
            url: 'ajax.php',
            data:{'status':status,'id':id,'order_id':order_id,'update_status_ship':'OK'},
            success:function(data){
                console.log(data);
                if(data.trim() == 'success') {
                    this2.find('.text_status').html('Change status');
                    this1.find('input[name=status_tmp]').val(status);
                    if(status == 0) stt = 'Delivering';
                    else if(status == 1) stt = 'Delivered';
                    else if(status == 2) stt = 'Cancel';
                    this1.find('.update_status').html(stt);
                    this2.removeClass('update_stt');
                    this2.addClass('change_status');
                    this2.attr('class','badge badge-default');
                    this2.prop('disabled', true);
                } else {
                    this1.find('.update_status').html('Delivered');
                    this2.find('.text_status').html('Change status');
                    this2.removeClass('update_stt');
                    this2.addClass('change_status');
                }
            }
        })
    })

    $('input[name=order]').on('keyup',function(){
        order_id = $('input[name=order]').val();
        user_id = $('select[name=user_id]').val();
        status = $('select[name=status]').val(); 

        $.ajax({
            type:'POST',
            url: 'ajax.php',
            data:{'order_id':order_id,'user_id':user_id,'status':status,'search_ship':'OK'},
            success:function(data){
                if(data.trim()!='') {
                     $('.search_ship').html(data);
                     $('.table_ship').DataTable();
                }
               
            }
        })
    });
    $(document).ready(function() {
        $(document).on('change','select[name=status], select[name=user_id]',function(){
            order_id = $('input[name=order]').val();
            user_id = $('select[name=user_id]').val();
            status = $('select[name=status]').val(); 

            $.ajax({
                type:'POST',
                url: 'ajax.php',
                data:{'order_id':order_id,'user_id':user_id,'status':status,'search_ship':'OK'},
                success:function(data){
                    if(data.trim()!='') {
                     $('.search_ship').html(data);
                     $('.table_ship').DataTable();
                }
                }
            })
        })
    })

// $('.change-trigger').popover({
//     placement : 'Right',
//     title : 'Change',
//     trigger : 'click',
//     html : true,
//     content : function(){
//         var content = '';
//         content = $('#html-div').html();
//         return content;
//     } 
// });

</script>
