<table id="table_promotion" class="table table-striped table-bordered table_promotion">
              <thead>

                <tr>
                 <th><input type="checkbox" name="check_all_promotion"></th>
                 <th>#</th>
                 <th>Date From</th>
                 <th>Date To</th>
                 <th>Image</th>
                 <th>Name</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>

               <?php
               foreach($promotions as $key=>$u):
                
                $image = 'us.png';
                if($u->image != '') {
                  $image = $u->image;
                }
                ?>
                <tr id="">
                 <td>
                  <input type="checkbox" name="check_promotion[]" value="<?php echo $u->id ?>">
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $u->date_from ?></td>
                <td><?php echo $u->date_to ?></td>
                <td><img src="public/images/<?php echo $image?>" width="60px" ></td>
                <td><?php echo $u->name ?> </td>
                <td>
                  <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <a class="dropdown-item  badge badge-info" href="promotion_edit.php?id=<?php echo $u->id?>"   data-index = "<?php echo $u->id?>" ><i class="fa fa-edit"></i> Update</a>
                    <a class="dropdown-item  badge badge-danger delete_promotion" href="javascript:void(0)"   data-index = "<?php echo $u->id?>" ><i class="fa fa-trash-o"></i> Delete</a>
                   </div>
                 </div>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach?>
      </tbody>
    </table>