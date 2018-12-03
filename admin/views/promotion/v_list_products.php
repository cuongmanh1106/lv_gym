<?php include("include/report.php") ; ?>

<div id="edit_detail_promotion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit MarginRight-10"></i>
          Edit Detail Promotion( <span id="product_name"></span> )</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" action="products_update_quantity.php">
            <div id="error">

            </div>
            <input type="hidden" name="detail_id">
            <div>
              <b>Price Out:</b> <span id="price_out"></span>  
            </div>
            <br>
            <b>Promotion Price</b>
            <input type="text" required="" name="promotion_price" onkeyup="formatNumBerKeyUp(this)" class="form-control">
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" style="text-align: center;" data-dismiss="modal" name="update_detail_product_promotion" class="btn btn-info"><i class="fa fa-save"></i> Save</button>

            </div>
          </form>
        </div>

      </div>

    </div>
  </div>
  <script type="text/javascript">
    $(document).on('click','button[name=update_quantity]',function(){
      if($('input[name=quantity]').val() == '') {
        alert('quantity must be required');
      } else {
        $('button[name=update_quantity').attr('type','submit');
      }
    })
  </script>




  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="promotion_list.php" style="color: blue">Promotions</a></li>
      <li class="breadcrumb-item active" aria-current="page">Details</li>
    </ol>
  </nav>
  <div class="content mt-3">
    <div class="animated fadeIn">
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header badge-info">
              <strong class="card-title"><i class="fa fa-list"></i> List Products Promotion</strong>
              <a class="btn btn-success" title="Add Product into promotion" href="promotion_choose_products.php?id=<?php echo $id?>" ><i class="fa fa-plus-circle"></i> </a>

            </div>
            <div class="search" style="margin-top: 20px">
             
           </div>
           <hr style="boder:0.5px solid #fff">
           <div class="card-body" id="search_promotion">

            <table id="table_promotion" class="table table-striped table-bordered table_promotion">
              <thead>

                <tr>
                 <th>#</th>
                 <th>Image</th>
                 <th>Name</th>
                 <th>Price Out</th>
                 <th>Price Promotion</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>

               <?php
               foreach($detail_promotions as $key=>$u):

                ?>
                <tr id="row_detail_promotion_<?php echo $u->id?>">
                
                <td><?php echo $key + 1 ?></td>
                <td><img src="public/images/<?php echo $u->image?>" alt="" width="150px"></td>
                <td><?php echo $u->name ?></td>
                <td><?php echo $u->price_out ?> </td>
                <td class="price_update"><?php echo $u->price ?> </td>
                <td>
                  <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <a class="dropdown-item  badge badge-info" href="#edit_detail_promotion" data-toggle="modal"   data-index = "<?php echo $u->id?>" ><i class="fa fa-edit"></i> Update</a>
                    <a class="dropdown-item  badge badge-danger delete_promotion_detail" href="javascript:void(0)"   data-index = "<?php echo $u->id?>" ><i class="fa fa-trash-o"></i> Delete</a>
                    
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
    $('.table_promotion').DataTable({
      "lengthMenu": [[-1], ["All"]]
    });
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

  $(document).on('show.bs.modal','#edit_detail_promotion',function(e){
    id = $(e.relatedTarget).data('index');

    $.ajax({
      type:'POST',
      url:'ajax.php',
      data:{'id':id,'get_detail_product_promotion':'OK'},
      dataType:'json',
      success:function(data) {
        $(e.currentTarget).find('#price_out').html(data.price_out);
        $(e.currentTarget).find('input[name=promotion_price]').val(data.price);
        $(e.currentTarget).find('#product_name').html(data.name);
        $(e.currentTarget).find('input[name=detail_id]').val(data.id);
      }
    })
  })

  $(document).on('click','button[name=update_detail_product_promotion]',function(){
    id = $('input[name=detail_id]').val();
    price = $('input[name=promotion_price]').val();
    price_out = $('#price_out').text();
    console.log(price_out); 
    var self = $(this);
    if(parseFloat(price) > parseFloat(price_out)) {
      $('#error').html('<div class ="alert alert-danger">Promotion price must be smaller than price out</div>');
    }  else {
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'price':price,'update_detail_product_promotion':'OK'},
        dataType:'json',
        success:function(data){
          if(data.error != null) {
            alert("Error Update");
          } else {
            // $("#edit_detail_promotion").attr("data-dismiss","modal");
            

            // $('#edit_detail_promotion').modal('hide');
            // $('#edit_detail_promotion').modal().hide();
            // $('#edit_detail_promotion').removeClass('show');

            $('#row_detail_promotion_'+id).find(".price_update").html(data.price);
            // $('#edit_detail_promotion').modal('toggle');
          }
        }
      })
    }
    
  })

  $(document).on('click','.delete_promotion_detail',function(){
    id = $(this).data('index');
    self = $(this);
    if (confirm('Are you sure when delete this product. Data Cannot be restore')) {
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'delete_promotion_detail':'OK'},
        success:function(data) {
          if(data.trim() == "success") {
            $('#row_detail_promotion_'+id).remove();
          }
        }
      })
    }

  })
</script>