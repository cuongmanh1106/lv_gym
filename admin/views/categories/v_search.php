<table id="table_cate" class="table table-striped table-bordered table_cate">
            <thead>
              <tr>
                <th><input type="checkbox" name="check_all_cate"></th>
                <th>#</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach($cates as $c): 
              $parent = $m_cate->read_cate_by_id($c->parent_id);
              $parent_name = "None";
              if($c->parent_id != 0) {
                $parent_name = $parent->name;
              }
              ?>
              <tr>
                <td><input type="checkbox" name="check_cate[]" value="<?php echo $c->id?>"></td>
                <td><?php echo $i?></td>
                <td><?php echo $c->name?></td>
                <td><?php echo $parent_name?></td>
                <td><?php echo $c->description?></td>
                <td>
                  <?php if($m_per->check_permission('edit_category')) {?>
                  <a href="cate_edit.php?id=<?php echo $c->id?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                  <?php } else {?>
                  <button type="button" class="btn btn-default" disabled><i class="fa fa-edit"></i></button>
                  <?php } ?>

                  <?php if($m_per->check_permission('delete_category')){?>
                  <a  href="javascript:void(0)" onclick="delete_cate(<?php echo $c->id?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                  <?php } else {?>
                  <button type="button" class="btn btn-default" disabled><i class="fa fa-trash-o"></i></button>
                  <?php }?>
                </td>
              </tr>
              <?php $i++; endforeach ?>
            </tbody>
          </table>