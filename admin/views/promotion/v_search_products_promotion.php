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
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = 1; foreach($products as $p): 
              
              $supplier = '';
              $cate_name = '';
              $cate = $m_cate->read_cate_by_id($p->cate_id);
              if(!empty($cate)) {
                $cate_name = $cate->name;
              }
              $sup = $m_sup->read_supply_by_id($p->sup_id);
              if(!empty($sup)) {
                $supplier = $sup->name;
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
              </td>
            </tr>
            <?php $i++; endforeach ?>
          </tbody>
        </table>