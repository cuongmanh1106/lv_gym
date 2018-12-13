<?php include("include/report.php") ; ?>
<?php include("v_add.php") ?>
<?php include("v_update_stock_receipt.php") ?>
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> List of stock receipt</strong>
            <?php if($m_per->check_permission("insert_stock") == 1){ ?>
              <a class="btn btn-success" href="#add_stock" data-toggle="modal" ><i class="fa fa-plus-circle"></i> </a>
            <?php } else {?>
              <button class="btn btn-success" disabled="" ><i class="fa fa-plus-circle"></i> </button>
            <?php }?>
          </div>
          <div class="search">
            <div class="col-md-4"><b>Stock No:</b>
             <input type="text" class="form-control" name="stock_no_search" placeholder=" Stock No...">
           </div>
           <div class="col-md-4"><b>Staff:</b>
             <select class="form-control selected2" name="user_stock_search">
              <option value="0">all</option>
              <?php foreach($users as $u):?>
                <option value="<?php echo $u->id?>"><?php echo $u->first_name?> <?php echo $u->last_name?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-4 col-md-offset-3"><b>Status:</b>
           <select name="status_stock_search" class="form-control">
             <option value="all">All</option>
             <option value="0">Entering</option>
             <option value="1">Confirmed</option>
             <option value="2">Cancel</option>
           </select>
         </div>
       </div>
       <hr style="boder:0.5px solid #fff">
       <div class="card-body" id="search_stock">
         <table id="table_stock" class="table table-striped table-bordered table_stock">
          <thead>

            <tr>
              <!--  <th><input type="checkbox" name="check_all_user"></th> -->
              <th>STT</th>
              <th>Date</th>
              <th>Stock No.</th>
              <th>Staff</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

           <?php
           foreach($stocks as $key=>$stock):
            $user = $m_user->read_user_by_id($stock->user_id);
            $user_name = $user->first_name . ' ' . $user->last_name;
            $status = '';
            if($stock->status == 0) {
              $status = "Entering";
            } else if($stock->status == 1) {
              $status = "Confirmed";
            } else if ($stock->status == 2) {
              $status = "Canceled";
            }

            ?>
            <tr id="">
                <!--  <td>
                  <input type="checkbox" name="check_user[]" value="<?php echo $stock->id ?>">
                </td> -->
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $stock->created_at ?></td>
                <td><?php echo $stock->id ?></td>
                <td><?php echo $user_name ?></td>
                <td><?php echo $stock->description ?></td>
                <td><?php echo $status?></td>
                <td>
                  <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <?php if($m_per->check_permission("list_detail_stock") == 1){ ?>
                      <a class="dropdown-item  badge badge-warning" href="stock_receipt_list_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-list-alt"></i> View list products</a>
                    <?php } else { ?>
                      <button class="dropdown-item  badge badge-warning" disabled  ><i class="fa fa-list-alt"></i> View list products</button>
                    <?php } ?>

                    <?php if($stock->status == 0 && $m_per->check_permission("edit_stock") == 1){ ?>
                    <!-- <a class="dropdown-item  badge badge-primary" href="stock_receipt_add_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-plus"></i> Add products</a>
                      <a class="dropdown-item  badge badge-info" href="stock_receipt_update_products.php?id=<?php echo $stock->id ?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-edit"></i> Update products</a> -->
                      <a class="dropdown-item  badge badge-info" href="#update_stock_receipt" data-toggle = "modal" data-status="<?php echo $stock->status?>"   data-index = "<?php echo $stock->id?>" ><i class="fa fa-edit"></i> Update Status</a>
                    <?php } else { ?>
                      <button class="dropdown-item  badge badge-info disabled" disabled=""  ><i class="fa fa-edit"></i> Update Status</button>
                    <?php } ?>
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

  $('input[name=stock_no_search]').on('keyup',function(){
    var stock_no = $('input[name=stock_no_search]').val();
    var user = $('select[name=user_stock_search]').val();
    var status = $('select[name=status_stock_search]').val();
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'stock_no':stock_no,'user':user,'status':status,'search_stock':'OK'},
      success: function(data,status) {
       $('#search_stock').html(data);
       $('.table_stock').DataTable();
     }
   })
  });
  $(document).ready(function(){
  $(document).on('change','select[name=user_stock_search], select[name=status_stock_search]',function(){
    var stock_no = $('input[name=stock_no_search]').val();
    var user = $('select[name=user_stock_search]').val();
    var status = $('select[name=status_stock_search]').val();
    console.log(user);
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'stock_no':stock_no,'user':user,'status':status,'search_stock':'OK'},
      success: function(data,status) {
       $('#search_stock').html(data);
       $('.table_stock').DataTable();
     }
   })
  })
})

  
</script>
<script type="text/javascript">

  $('#update_stock_receipt').on('show.bs.modal', function(e) {
    stock_id  = $(e.relatedTarget).data('index');
    status = $(e.relatedTarget).data('status');
    // $(e.currentTarget).find('select[name=stock_status]').val(status);
    $(e.currentTarget).find('input[name=stock_id]').val(stock_id);

  })
</script>