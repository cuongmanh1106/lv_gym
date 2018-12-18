<?php include("include/report.php") ; ?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> Users</strong>
            <?php if($m_per->check_permission('insert_user') == 1){?>
            <a class="btn btn-success" href="user_add.php" ><i class="fa fa-plus-circle"></i> </a>
            <?php } else {?>
            <button class="btn btn-default" disabled  ><i class="fa fa-plus-circle"></i> </a>
            <?php }?>

            <?php if($m_per->check_permission('delete_user') == 1) {?>
            <button class="btn btn-danger" id="del_user"  ><i class="fa fa-trash-o"></i> </a>
            <?php } else {?>
            <button class="btn btn-default" disabled  ><i class="fa fa-trash-o"></i> </a>
            <?php }?>
            </div>
            <div class="search" style="margin-top: 20px">
             <div class="col-md-6 col-md-offset-3">
               <input type="text" class="form-control" name="name_search" placeholder=" Last Name...">
             </div>
             <div class="col-md-6 col-md-offset-3">
               <select name="permission_search" required="required" id="select" class="form-control">
                <option value="all">All</option>
                
                <?php foreach($permission as $p): ?>
                  <option value="<?php echo $p->id ?>"><?php echo  $p->name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <hr style="boder:0.5px solid #fff">
          <div class="card-body" id="search_user">

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
                 $permission_tmp = $m_user->read_permission_by_id($u->permission_id);
                 $permission_name = '';
                 if($permission_tmp) {
                  $permission_name = $permission_tmp->name;
                }
                $image = 'us.png';
                if($u->image != '') {
                  $image = $u->image;
                }
                ?>
                <tr id="">
                 <td>
                  <?php if($permission_tmp->id != 1) {?>
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
                  <!--Edit permission user-->
                  <?php if($m_per->check_permission('edit_user') == 1 && $u->permission_id != 1 && $u->permission_id != 6){ ?>
                  <a class="dropdown-item badge badge-success" data-id = "<?php echo $u->id ?>" data-name="<?php echo $u->first_name?> <?php echo $u->last_name?>" data-permission="<?php echo $u->permission_id?>"   href="#edit_permission" data-toggle="modal"><i class="fa fa-edit"></i> Edit permission</a>
                  <?php } else if($m_per->check_permission('edit_user') == 0 && $u->permission_id != 1) {?>
                  <button class="badge badge-default" disabled=""><i class="fa fa-edit"></i> Edit permission</button>
                  <?php }?>
                  
                  <!--Delete user-->
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
  </div>
</div>
</div>


</div>
</div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->

<div id="edit_permission" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit MarginRight-10"></i>
          Edit Permission (<span id="user_name"></span>)</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <div class="profile_validation"></div>
        <form method="POST" enctype="multipart/form-data" action="user_edit_permission.php">

          <input type="hidden" name="user_id" value="">
       
          <div class="row form-group">
            <div class="col-md-2"><label for="text-input" class=" form-control-label">Permission:</label></div>
            <div class="col-md-9">
              <select  required="required" id="text-input" name="permission_id" class="form-control">
                <?php foreach($permission as $p): ?>
                  <?php if($p->id != 1) {?>
                  <option value="<?php echo $p->id ?>"><?php echo  $p->name ?></option>
                  <?php }?>
                <?php endforeach; ?>
              </select>
          </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-reply"></i> Close</button>
            <button type="submit" name="update_prof" id="update_profile" style="text-align: center;" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Save</button>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>



<script type="text/javascript">
  $(document).ready(function(){
    $('.table_user').DataTable();
  })
  $(document).on('click','.delete_user',function(){
    id = $(this).attr('data-index');
    this1 = $(this);

    if(confirm("data will not restore again, Are you sure?")){
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'delete_user':'OK'},
        success:function(data) {
          if (data.trim() == "error") {
            alert("Error Delete");
          } else if (data.trim() == "permission") {
            alert("You dont have permission to do this action !!!!");
          } else {
            $('#search_user').html(data);
            $('.table_user').DataTable();
          }
        }
      })
    }
  })

  $('select[name=permission_search').on('change',function(){
    var name = $('input[name=name_search]').val();
    var permission = $('select[name=permission_search]').val();
    console.log(name + " " + permission);
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'name':name, 'permission':permission,'search_user':'OK'},
      success: function(data,status) {
        $('#search_user').html(data);
        $('.table_user').DataTable();
      }
    })
  });
  $('input[name=name_search').on('keyup',function(){
    var name = $('input[name=name_search]').val();
    var permission = $('select[name=permission_search]').val();
    console.log(name + " " + permission);
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'name':name, 'permission':permission, 'search_user':'OK'},
      success: function(data,status) {
        $('#search_user').html(data);
        $('.table_user').DataTable();
      }
    })
  });

  
</script>
<script type="text/javascript">
  var checked = [];
  $(document).on('click','input[name=check_all_user]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_user[]"]').each(function(i,n){
        if($(n).is(':checked')) {
          checked.push(parseInt($(n).val()));
        } else {
          var i = checked.indexOf(parseInt($(n).val()));
          if(i != -1) {
            checked.splice(i,1);
          }
        }
      })
    } else {
      $('input:checkbox').prop('checked',false);
      $('input[name="check_user[]"]').each(function(i,n){
        if($(n).is(':checked')) {
          checked.push(parseInt($(n).val()));
        } else {
          var i = checked.indexOf(parseInt($(n).val()));
          if(i != -1) {
            checked.splice(i,1);
          }

        }
      })
    }
    console.log(checked);


  })

  $(document).on('click','input[name="check_user[]"]',function(){
    var thischeck = $(this) ;
    if(thischeck.is(':checked')) {
      checked.push(parseInt(thischeck.val()));
      console.log(checked);
    } else {
      var i = checked.indexOf(parseInt(thischeck.val()));
      if(i != -1) {
        checked.splice(i,1);
      }
    }
  })
  $(document).on('click','#del_user',function(){
    var requestData = JSON.stringify(checked);
    console.log(requestData);
    if(requestData == '[]') {
      alert('please choose product to delete');
    }
    else if(confirm('data will not be restore\nAre you sure')){
      var requestData = JSON.stringify(checked); //gửi requrest bằng mảng
      
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'list_id':requestData,'delete_group_user':'OK'},
        success:function(data){
          if(data.trim() == 'error'){
            alert("Error Delete");
          } else if(data.trim() == "permission") {
            alert("You dont have permission to do this action !!!");
          } else {
            $('#search_user').html(data);
            $('.table_user').DataTable();
          }
        }

      })
    } 
    
  })

  $('#edit_permission').on('show.bs.modal',function(e) {
    id = $(e.relatedTarget).data('id');
    name = $(e.relatedTarget).data('name');
    permission_id = $(e.relatedTarget).data('permission');

    $(e.currentTarget).find('input[name=user_id]').val(id);
    $(e.currentTarget).find('#user_name').html(name);
    $(e.currentTarget).find('select[name=permission_id]').val(permission_id);
  })
</script>