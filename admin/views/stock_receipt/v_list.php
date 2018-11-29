<?php include("include/report.php") ; ?>
<?php include("v_add.php") ?>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> List of stock receipt</strong>
            <a class="btn btn-success" href="#add_stock" data-toggle="modal" ><i class="fa fa-plus-circle"></i> </a>
            <button class="btn btn-danger" id="del_user"  ><i class="fa fa-trash-o"></i> </a>
            </div>
            <div class="search" style="margin-top: 20px">
             <div class="col-md-12 col-md-offset-3">
               <input type="text" class="form-control" name="name_search" placeholder=" Last Name...">
             </div>

           </div>
           <hr style="boder:0.5px solid #fff">
           <div class="card-body" id="search_user">

            <table id="table_stock" class="table table-striped table-bordered table_stock">
              <thead>

                <tr>
                 <th><input type="checkbox" name="check_all_user"></th>
                 <th>STT</th>
                 <th>Date</th>
                 <th>Stock No.</th>
                 <th>Staff</th>
                 <th>Description</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>

               <?php
               foreach($stocks as $key=>$stock):
                $user = $m_user->read_user_by_id($stock->user_id);
                $user_name = $user->first_name . ' ' . $user->last_name;

                ?>
                <tr id="">
                 <td>
                  <input type="checkbox" name="check_user[]" value="<?php echo $stock->id ?>">
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $stock->created_at ?></td>
                <td><?php echo $stock->id ?></td>
                <td><?php echo $user_name ?></td>
                <td><?php echo $stock->description ?></td>
                <td>
                  <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <a class="dropdown-item  badge badge-warning" href="stock_receipt_list_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-list-alt"></i> View list products</a>
                    <a class="dropdown-item  badge badge-primary" href="stock_receipt_add_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-plus"></i> Add products</a>
                    <a class="dropdown-item  badge badge-info" href="stock_receipt_update_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-edit"></i> Update products</a>
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
    $('.table_stock').DataTable();
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