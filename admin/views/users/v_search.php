<table id="table_user" class="table table-striped table-bordered table_user">
              <thead>

                <tr>
                 <th><input type="checkbox" name="check_all_user"></th>
                 <th>STT</th>
                 <th>Image</th>
                 <th>Name</th>
                 <th>Permission</th>
                 <th>Email</th>
                 <th>SDT</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>

               <?php
               foreach($users as $key=>$u):
                 $permission = $m_user->read_permission_by_id($u->permission_id);
                 $permission_name = '';
                 if($permission) {
                  $permission_name = $permission->name;
                }
                $image = 'us.png';
                if($u->image != '') {
                  $image = $u->image;
                }
                ?>
                <tr id="">
                 <td>
                  <?php if($permission->id != 1) {?>
                  <input type="checkbox" name="check_user[]" value="<?php echo $u->id ?>">
                  <?php }?>
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><img src="public/images/<?php echo $image?>" width="60px" ></td>
                <td><?php echo $u->first_name ?> <?php echo $u->last_name ?></td>
                <td><?php echo $permission_name ?></td>
                <td><?php echo $u->email ?></td>
                <td><?php echo $u->phone_number ?></td>
                <td>
                  <?php if($m_per->check_permission('delete_user') == 1 && $u->permission_id != 1){ ?>
                  <a class="dropdown-item badge badge-danger delete_user" data-index = "<?php echo $u->id ?>"  id="delete_user"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Delete</a>
                  <?php } else if($m_per->check_permission('delete_user') == 0 && $u->permission_id != 1) {?>
                  <button class="badge badge-default" disabled=""><i class="fa fa-trash-o"></i> Delete</button>
                  <?php }?>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach?>
      </tbody>
    </table>