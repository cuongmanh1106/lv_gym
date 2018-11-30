<table id="table_list_stock" class="table table-striped table-bordered table_list_stock">
            <thead>
              <tr>
                <th><input type="checkbox" name="check_all_stock"></th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              for($j=0;$j<count($products);$j++) {
              $p = $products[$j];
              $detail = $m_stock->read_detail_by_stock_product($stock_id,$p->id);
              $status = '';
              if($detail->status == 1) {
                $status = "Update";
              } else {
                $status = "New";
              }

              $supplier = '';
              $cate_name = '';
              $sup = $m_sup->read_supply_by_id($p->sup_id);
              if(!empty($sup)) {
                $supplier = $sup->name;
              }
              $cate = $m_cate->read_cate_by_id($p->cate_id);
              if(!empty($cate)){
                $cate_name = $cate->name;
              }
              $size = json_decode($p->size);
              $quantity = $p->quantity;
              if($p->status == 2) {
                $size = json_decode($detail->size);
                $quantity = $detail->quantity;
              }
              $disable_edit_quantity = '';
              $size_name = '';
              if(count($size) != 0) {
                $size_name .=' (';
                $disable_edit_quantity = 'disabled';
                foreach ($size as $key => $value) {
                  $size_name .= $key .' => ' . $value.' ' ;
                }
                $size_name .= ' )';
              } else {
                $size_name .= 'None';
              }


              ?>
              <tr class="row_stock_<?php echo $detail->id?>">
                <td><input type="checkbox" name="check_stocks[]" value="<?php echo $detail->id?>"></td>
                <td><img src="public/images/<?php echo $p->image?>" width="150px"></td>
                <td><?php echo $p->name?></td>
                <td align="right"><?php echo number_format($p->price_in,2)?></td>
                <td><?php echo $cate_name?></td>
                <td><?php echo $supplier?></td>
                <td><?php echo $p->quantity?></td>
                <td><?php echo $size_name?></td>
                <td><?php echo $status?></td>
                <td>
                 <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <a class="dropdown-item  badge badge-primary" href="products_edit.php?id=<?php echo $p->id?>"><i class="fa fa-edit"> </i> Edit Infomation</a>
                    <a class="dropdown-item badge badge-primary edit_sub_img" data-name="<?php echo $p->name?>" data-proid="<?php echo $p->id?>"   data-toggle="modal" href="#edit_sub_image"><i class="fa fa-retweet"></i> Edit Sub Image</a>
                    <a class="dropdown-item  badge badge-info" href="stock_receipt_update_size_qty.php?pro_id=<?php echo $p->id ?>&stock_id=<?php echo $stock_id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-edit"></i> Update Size & Qty</a>
                    <a class="dropdown-item badge badge-danger delete_stock" data-index="<?php echo $detail->id?>"  href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
                    
                  </div>
                </div>
              </td>
            </tr>
            <?php $i++; } ?>
          </tbody>
        </table>