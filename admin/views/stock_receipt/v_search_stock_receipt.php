<table id="table_stock" class="table table-striped table-bordered table_stock">
          <thead>

            <tr>
              <!--  <th><input type="checkbox" name="check_all_user"></th> -->
              <th>STT</th>
              <th>Date</th>
              <th>Stock No.</th>
              <th>Staff</th>
              <th>Supplier</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

           <?php
           foreach($stocks as $key=>$stock):
            $user = $m_user->read_user_by_id($stock->user_id);
            $user_name = $user->first_name . ' ' . $user->last_name;
            $status = '';
            if($stock->status == 0) {
              $status = "Entering";
            } else if($stock->status == 1) {
              $status = "Confirmed";
            } else if ($stock->status == 2) {
              $status = "Canceled";
            }
            $sub_name = "";
            $sup_tmp = $m_sup->read_supply_by_id($stock->sup_id);
            if(!empty($sup_tmp)) {
              $sub_name = $sup_tmp->name;
            }
            ?>
            <tr id="">
                <!--  <td>
                  <input type="checkbox" name="check_user[]" value="<?php echo $stock->id ?>">
                </td> -->
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $stock->created_at ?></td>
                <td><?php echo $stock->id ?></td>
                <td><?php echo $user_name ?></td>
                <td><?php echo $sub_name?></td>
                <td><?php echo $stock->description ?></td>
                <td><?php echo $status?></td>
                <td>
                  <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <?php if($m_per->check_permission("list_detail_stock") == 1){ ?>
                      <a class="dropdown-item  badge badge-warning" href="stock_receipt_list_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-list-alt"></i> View list products</a>
                    <?php } else { ?>
                      <button class="dropdown-item  badge badge-warning" disabled  ><i class="fa fa-list-alt"></i> View list products</button>
                    <?php } ?>

                    <?php if($stock->status == 0 && $m_per->check_permission("edit_stock") == 1){ ?>
                    <!-- <a class="dropdown-item  badge badge-primary" href="stock_receipt_add_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-plus"></i> Add products</a>
                      <a class="dropdown-item  badge badge-info" href="stock_receipt_update_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-edit"></i> Update products</a> -->
                      <a class="dropdown-item  badge badge-info" href="#update_stock_receipt" data-toggle = "modal" data-status="<?php echo $stock->status?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-edit"></i> Update Status</a>
                    <?php } else { ?>
                      <button class="dropdown-item  badge badge-info disabled" disabled=""  ><i class="fa fa-edit"></i> Update Status</button>
                    <?php } ?>
                  </div>
                </div>
              </td>
            </tr>
          <?php endforeach?>
        </tbody>
      </table>