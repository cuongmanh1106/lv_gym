<table id="bootstrap-data-table" class="table table-striped table-bordered table_feedback search_cate">
            <thead>

              <tr>
                <th><input type="checkbox" name="check_all_contact"></th>
                <th>STT</th>
                <th>Customer </th>
                <th>Content</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
              foreach($contacts as $key=>$p):
              $user = $m_user->read_user_by_id($p->customer_id);
              ?>
              <tr id="">
                <td><input type="checkbox" name="check_contact[]" value="<?php echo  $p->id ?>"></td>
                <td><?php echo $key ?></td>
                <td><?php echo $user->first_name ?> <?php echo  $user->last_name ?></td>
                <td><?php echo substr($p->content,0,100) ?></td>
                <td>
                  <?php if($p->status == 0) {?>
                  <label class="badge badge-success status">New</label></td>
                  <?php } else { ?> 
                  <label class="badge badge-info">Seen</label></td>
                  <?php }?>
                <td>
                  <?php if($p->status != 1) {?>
                   <button  data-index="<?php  $p->id ?>" class="badge badge-success seen_contact" ><i class="fa fa-eye"> Seen</i></button>
                  <?php }else { ?> 
                  <button disabled=""  class="badge badge-default" ><i class="fa fa-eye"> Seen</i></button>
                  <?php }?>
                 
                  <button data-index = "<?php echo $p->id ?>"  class="badge badge-danger delete_contact" ><i class="fa fa-trash-o"> Delete</i></button>
                  <button class="badge badge-primary" data-viewid="<?php echo $p->id ?>"  data-toggle="modal" data-target="#view_contact"><i class="fa fa-retweet"></i> view</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>