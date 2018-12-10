<?php

// $cate_name = '';
//               $cate = $m_cate->read_cate_by_id($p->cate_id);
//               if(!empty($cate)) {
//                 $cate_name = $cate->name;
//               }
?>

          <table id="table_pro" class="table table-striped table-bordered table_pro">
            <thead>
              <tr>
                <th><input type="checkbox" name="check_all"></th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Introduce</th>
                <th>Size</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach($products as $p): 
              $supplier = '';
              $sup = $m_sup->read_supply_by_id($p->sup_id);
              if(!empty($sup)) {
                $supplier = $sup->name;
              }
              $cate_name = '';
              $cate = $m_cate->read_cate_by_id($p->cate_id);
              if(!empty($cate)) {
                $cate_name = $cate->name;
              }
              $size = json_decode($p->size);
              $disable_edit_quantity = '';
              $size_name = '[';
              if(count($size) != 0) {
                $disable_edit_quantity = 'disabled';
                foreach ($size as $key => $value) {
                  $size_name .= $key .' - ';
                }
              }
              $size_name .= ']';


              ?>
              <tr class="row_pro_<?php echo $p->id?>">
                <td><input type="checkbox" name="check_products[]" value="<?php echo $p->id?>"></td>
                <td><img src="public/images/<?php echo $p->image?>" width="150px"></td>
                <td><?php echo $p->name?></td>
                <td align="right"><?php echo number_format($p->price,2)?></td>
                <td><?php echo $cate_name?></td>
                <td><?php echo $supplier?></td>
                <td><?php echo $p->quantity?></td>
                <td><?php echo substr($p->intro,0,30)  ?>.....</td>
                <td><?php echo $size_name?></td>
                <td>
                 <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <?php if(count($size) > 0) {?>
                    <a class="dropdown-item badge badge-warning" data-index="<?php echo $p->id?>"  href="#edit_size" data-toggle="modal" data-proid="<?php echo $p->id?>" data-name="<?php echo $p->name?>"><i class="fa fa-trash-o"></i> View Detail Size</a>
                    <?php }?>
                    <?php if($m_per->check_permission('edit_product') ==  1) { ?>
                    <a class="dropdown-item  badge badge-primary" href="products_edit.php?id=<?php echo $p->id?>"><i class="fa fa-edit"></i> Edit</a>
                    <a class="dropdown-item badge badge-success edit_sub_img" data-name="<?php echo $p->name?>" data-proid="<?php echo $p->id?>"   data-toggle="modal" href="#edit_sub_image"><i class="fa fa-retweet"></i> Edit Sub Image</a>
                    
                    
                    <?php } else {?> <!--end if permission-->
                    <button class="dropdown-item  badge badge-primary" disabled><i class="fa fa-edit"></i> Edit</button>
                    <button class="dropdown-item badge badge-success" disabled><i class="fa fa-retweet"></i> Edit Sub Image</button>
                    
                    <?php }?>

                    <?php if($m_per->check_permission('delete_product') == 1) {?>
                    <?php if(count($size) > 0) { ?>
                    <a class="dropdown-item badge badge-danger" href="#destroy_product_size" data-toggle="modal" data-index="<?php echo $p->id?>" data-proid="<?php echo $p->id?>" data-name="<?php echo $p->name?>"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Destroy Product</a>
                    <?php } else {?>
                      <a class="dropdown-item badge badge-danger" href="#edit_quantity" data-toggle="modal" data-index="<?php echo $p->quantity?>" data-proid="<?php echo $p->id?>" data-name="<?php echo $p->name?>"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Destroy Product</a>
                    <?php }?>
                    <a class="dropdown-item badge badge-danger delete_pro" data-index="<?php echo $p->id?>"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Delete</a>


                    <?php } else {?>
                    <button class="dropdown-item badge badge-success " disabled ><i class="fa fa-retweet"></i> Delete</button>
                    <?php }?>

                  </div>
                </div>
              </td>
            </tr>
            <?php $i++; endforeach ?>
          </tbody>
        </table>