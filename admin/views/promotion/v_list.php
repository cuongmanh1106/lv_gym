<?php include("include/report.php") ; ?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> Promotions</strong>
            <a class="btn btn-success" href="promotion_add.php" ><i class="fa fa-plus-circle"></i> </a>
            <a class="btn btn-danger" href="javascript:void(0)" id="delete_group_promotion" ><i class="fa fa-trash-o"></i> </a>
            
            </div>
            <div class="search" style="margin-top: 20px">
             <div class="col-md-4"><b>Name:</b>
               <input type="text" class="form-control" name="name_search" placeholder=" Name...">
             </div>
             <div class="col-md-4"><b>Date From:</b>
               <input type="date" class="form-control" name="date_from_search" placeholder=" Date From....">
            </div>
            <div class="col-md-4 col-md-offset-3"><b>Date To:</b>
               <input type="date" class="form-control" name="date_to_search" placeholder=" Date To....">
            </div>
          </div>
          <hr style="boder:0.5px solid #fff">
          <div class="card-body" id="search_promotion">

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
                $date  = date('Y-m-d');
                $highlight = "";
                if($date >= $u->date_from && $date <= $u->date_to ) {
                  $highlight = "background-color: #ffff00";
                }
                ?>
                <tr style="<?php echo $highlight?>" id="">
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
                    <a class="dropdown-item  badge badge-warning" href="promotion_list_products.php?id=<?php echo $u->id?>"   data-index = "<?php echo $u->id?>" ><i class="fa fa-trash-o"></i> List Products Promotion</a>
                   </div>
                 </div>
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
  $(document).on('click','.delete_promotion',function(){
    id = $(this).attr('data-index');
    this1 = $(this);

    if(confirm("data will not restore again, Are you sure?")){
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'delete_promotion':'OK'},
        success:function(data) {
          if (data.trim() == "error") {
            alert("Error Promotion");
          } else if (data.trim() == "permission") {
            alert("You dont have permission to do this action !!!!");
          } else {
            alert("success");
            $('#search_promotion').html(data);
            $('.table_promotion').DataTable();
          }
        }
      })
    }
  })

  $('input[name=date_from_search], input[name=date_to_search]').on('change',function(){
    var name = $('input[name=name_search]').val();
    var date_from = $('input[name=date_from_search]').val();
    var date_to = $('input[name=date_to_search]').val();
    console.log(date_from+" - "+date_to);
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'name':name, 'date_from':date_from,'date_to':date_to,'search_promotion':'OK'},
      success: function(data,status) {
        $('#search_promotion').html(data);
        $('.table_promotion').DataTable();
      }
    })
  });
  $('input[name=name_search]').on('keyup',function(){
    var name = $('input[name=name_search]').val();
    var date_from = $('input[name=date_from_search]').val();
    var date_to = $('input[name=date_to_search]').val();
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'name':name, 'date_from':date_from,'date_to':date_to,'search_promotion':'OK'},
      success: function(data,status) {
        $('#search_promotion').html(data);
        $('.table_promotion').DataTable();
      }
    })
  });

  
</script>
<script type="text/javascript">
  var checked = [];
  $(document).on('click','input[name=check_all_promotion]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_promotion[]"]').each(function(i,n){
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
      $('input[name="check_promotion[]"]').each(function(i,n){
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

  $(document).on('click','input[name="check_promotion[]"]',function(){
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
  $(document).on('click','#delete_group_promotion',function(){
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
        data:{'list_id':requestData,'delete_group_promotion':'OK'},
        success:function(data){
          if(data.trim() == 'error'){
            alert("Error Delete");
          } else if(data.trim() == "permission") {
            alert("You dont have permission to do this action !!!");
          } else {
            $('#search_promotion').html(data);
            $('.table_promotion').DataTable();
          }
        }

      })
    } 
    
  })
</script>