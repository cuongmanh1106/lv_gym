
<?php include("include/report.php") ?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> Orders</strong>
            <?php include("include/report.php") ?>
          </div>
          <div class="clearfix"></div>
          <div class="search" style="margin-top: 20px">
            <div class="col-md-2">
              Order:<input type="text" name="order" class="form-control" placeholder="Order number..." onkeypress="return isNumberKey(event)">
            </div>
            <div class="col-md-2">
              Customer:<select  class="selected2 form-control" name="cus_search" id="select">
                <option value="all">--All--</option>
                <?php foreach($customer as $cus):?>
                <option value="<?php echo $cus->id ?>"><?php echo $cus->first_name?> <?php echo $cus->last_name?></option>
                <?php endforeach?>
              </select>
            </div>
            <div class="col-md-2">
              Status:
              <select class="selected2 form-control" name="status_search" >
                <option value="all">--all--</option>
                <?php foreach($status as $stt):?>
                <option value="<?php echo $stt->id?>"><?php echo $stt->name ?></option>
                <?php endforeach ?>

              </select>
            </div>

            <div class="col-md-3">
              Date from:
              <input class="form-control" type="date" name="date_from">
            </div>
            <div class="col-md-3">
              Date to:
              <input class="form-control" type="date" name="date_to">
            </div>

          </div>
          <hr style="boder:0.5px solid #fff">
          <div class="card-body order_search">

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
                  <td><?php echo $c->updated_at ?></td>
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
          </div>
        </div>
      </div>

      <select class="selected2" name="a"><option>a</option><option>a</option></select>
    </div>
  </div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change','select[name=cus_search], select[name=status_search], input[name=date_from], input[name=date_to]',function(){
      cus_search = $('select[name=cus_search]').val();
      status_search = $('select[name=status_search]').val();
      date_from = $('input[name=date_from]').val();
      date_to = $('input[name=date_to]').val();
      order = $('input[name=order]').val();
      $.ajax({
        type:'POST',
        url: 'ajax.php',
        data:{'cus_search':cus_search,'status_search':status_search,'date_from':date_from,'date_to':date_to,'order':order,'search_order':'OK'},
        success:function(data) {
          $('.order_search').html(data);
          $('.table_order').DataTable();
        }
      })
    })

    $(document).on('keyup','input[name=order]',function(){
      cus_search = $('select[name=cus_search]').val();
      status_search = $('select[name=status_search]').val();
      date_from = $('input[name=date_from]').val();
      date_to = $('input[name=date_to]').val();
      order = $('input[name=order]').val();
      
      $.ajax({
        type:'POST',
        url: 'ajax.php',
        data:{'cus_search':cus_search,'status_search':status_search,'date_from':date_from,'date_to':date_to,'order':order,'search_order':'OK'},
        success:function(data) {
          $('.order_search').html(data);
          $('.table_order').DataTable();
        }
      })
    })
    
  })


</script>