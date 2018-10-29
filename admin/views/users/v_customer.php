<?php include("include/report.php") ; ?>
<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Users</h1>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">

      </div>
    </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">Users</strong>
            <?php if($m_per->check_permission('delete_user') == 1) { ?>
            <button class="btn btn-danger" id="del_user"  ><i class="fa fa-trash-o"></i> </a>
              <?php } else {?>
              <button class="btn btn-default" disabled   ><i class="fa fa-trash-o"></i> </a>
                <?php }?>
              </div>
              <div class="search" style="margin-top: 20px">
               <div class="col-md-12 col-md-offset-3">
                 <input type="text" class="form-control" name="name_search" placeholder=" Last Name...">
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
                   <th>Email</th>
                   <th>SDT</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>

                 <?php
                 foreach($users as $key=>$u):

                  $image = 'us.png';
                  if($u->image != '') {
                    $image = $u->image;
                  }
                  ?>
                  <tr id="">
                   <td>
                    <input type="checkbox" name="check_user[]" value="<?php echo $u->id ?>">
                  </td>
                  <td><?php echo $key + 1 ?></td>
                  <td><img src="public/images/<?php echo $image?>" width="60px" ></td>
                  <td><?php echo $u->first_name ?> <?php echo $u->last_name ?></td>
                  <td><?php echo $u->email ?></td>
                  <td><?php echo $u->phone_number ?></td>
                  <td>
                    <?php if($m_per->check_permission('delete_user') == 1) { ?>
                    <a class="dropdown-item badge badge-danger delete_user" data-index = "<?php echo $u->id ?>"  id="delete_user"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Delete</a>
                    <?php } else {?>
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
        data:{'id':id,'delete_customer':'OK'},
        success:function(data) {
          if (data.trim() == "error") {
            alert("Error Delete");
          } else if(data.trim() == "permission") {
            alert('You dont have permission to do this action');
          } else {
            $('#search_user').html(data);
            $('.table_user').DataTable();
          }
        }
      })
    }
  })

  $('input[name=name_search]').on('keyup',function(){
    var name = $('input[name=name_search]').val();
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'name':name,'search_customer':'OK'},
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
        data:{'list_id':requestData,'delete_group_customer':'OK'},
        success:function(data){
          if(data.trim() == 'error'){
            alert("Error Delete");
          } else if(data.trim() == "permission"){
            alert("You dont have permission to do this action");
          } else {
            $('#search_user').html(data);
            $('.table_user').DataTable();
          }
        }

      })
    } 
    
  })
</script>