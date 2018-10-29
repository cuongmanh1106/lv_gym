<?php require("../helper/help.php"); ?>

<?php require("include/report.php");?>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">List Of Category</strong>
            <?php if($m_per->check_permission('insert_category') == 1) {?>
            <span class="btn btn-success" data-toggle="modal" data-target="#add_cate"><i class="fa fa-plus"></i></span>
            <?php } else {?>
            <button type="button" class="btn btn-default" disabled><i class="fa fa-plus"></i></button>
            <?php }?>

            <?php if($m_per->check_permission('delete_category')) {?>
            <button class="btn btn-danger" name="delete_cate" ><i class="fa fa-trash-o"></i></button>
            <?php } else {?>
            <button type="button" class="btn btn-default" disabled><i class="fa fa-trash-o"></i></button>
            <?php }?>
          </div> 
          <!--search form-->
          <div class="search" style="margin-top: 20px">
           <div class="col-md-6 md-offset-3">Name
             <input type="text" class="form-control" name="name_search" placeholder=" Name...">
           </div>
           <div class="col-md-6 md-offset-3">
            Parent:
            <select name="parent_search" required="required" id="select" class="form-control selected2">
              <option value="all">All</option>
              <option value="0">None</option>
              <?php cate_parent($cates); ?>
            </select>
          </div>
        </div>
        <!--search form-->
        <hr style="boder:0.5px solid #fff">
        <div class="card-body" id="cate_search">
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
        </div>
      </div>
    </div>


  </div>
</div><!-- .animated -->
</div><!-- .content -->

<?php require("v_add.php"); ?>
<script>
  $(document).ready(function(){
    $('.table_cate').DataTable({
            // "aaSorting":[[2,"asc"]]
            // "lengthMenu": [[10, 25, 50, -1], [20, 25, 50, "All"]]
          })


  })
</script>

<script>
  function delete_cate(id) {
    if(confirm("Are you your? data will not be restore")) {
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'delete_cate':'OK'},
        cache:false,
        success:function(data){

          if(data.trim() == 'error_delete') {
            alert("Error Delete");
          } else if(data.trim() == 'error_parent') {
            alert("This category has category children please check it!! ");

          } else if(data.trim() == "permission") {
            alert("You don't have permission to do this action");
          } else {
            alert("Succesfully");
            $('input[name=name_search]').val('');
            $('select[name=parent_search]').val('all');
            $('#cate_search').html(data);
            $('.table_cate').DataTable();
          }
          
        }
      })
    }
    
  }
</script>


<!--Delete group-->
<script>
  var checked = [];
  $(document).on('click','input[name=check_all_cate]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_cate[]"]').each(function(i,n){
        if($(n).is(':checked')) {
          checked.push(parseInt($(n).val()));
        } else {
          var i = checked.indexOf(parseInt($(n).val()));
          if(i != -1) {
            checked.splice(i,1);
          }
        }
      });
    } else {
      $('input:checkbox').prop('checked',false);
      $('input[name="check_cate[]"]').each(function(i,n){
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
  $(document).on('click','input[name="check_cate[]"]',function(){
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
    console.log(checked);
  })
  $(document).on('click','button[name=delete_cate]',function(){
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
        data:{'list_id':requestData,'delete_group':'OK'},
        success:function(data){
         if(data.trim() == 'parent_error') {
          $("input[name=name_search]").val('');
          alert('this cate has sub-cate!!! please delete sub-cate first');
        } else if(data.trim() == "permission") {
          alert("You dont have permission to do this action");
        } else {
          $("input[name=name_search]").val('');
          $("select[name=cate_search").val('all');
          $('#cate_search').html(data);
          $('.table_cate').DataTable();
        }
      }

    })
    } 

  })
</script>
<!--Delete group-->

<!--Search-->
<script>
  $(document).ready(function(){
    $('input[name=name_search]').on('keyup',function(){
      var name = $('input[name=name_search]').val();
      var parent = $('select[name=parent_search]').val();
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'search_cate':'OK','name':name, 'parent': parent},
        success: function(data){
          console.log(data);
          $('#cate_search').html(data);
          $('.table_cate').DataTable({})

        }
      })
    })

    $('select[name=parent_search]').on('change',function(){
      var name = $('input[name=name_search]').val();
      var parent = $('select[name=parent_search]').val();
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'search_cate':'OK','name':name, 'parent': parent},
        success: function(data){
          console.log(data);
          $('#cate_search').html(data);
          $('.table_cate').DataTable({})

        }
      })
    })
  })
</script>