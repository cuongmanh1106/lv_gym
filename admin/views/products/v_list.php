

<?php require("include/report.php");?>
<?php include("v_edit_sub_image.php");?>
<?php include("v_edit_size.php");?>
<?php include("v_edit_quantity.php");?>
<?php include("v_destroy_product_size.php") ?>
<?php include("v_list_destroy_products.php") ?>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info ">
            <strong class="card-title"><i class="fa fa-list"></i> List Of Products </strong>

            <?php if($m_per->check_permission('delete_product') == 1) {?>
            <button class="btn btn-danger" id="delete_group_product" name="delete_group_product" ><i class="fa fa-trash-o"></i></button>
            <?php } else {?>
            <button disabled class="btn btn-default" ><i class="fa fa-trash-o"></i></button>
            <?php }?>
            <button data-toggle="modal" data-target="#list_destroy_product" class="btn btn-success"><i class="fa fa-eye"> List Destroy Products</i></button>
          </div> 
          <!--search form-->
          <div class="search" style="margin-top: 20px">
           <div class="col-md-3">
             <input type="text" class="form-control" name="name_search" placeholder=" Name...">
           </div>
           <div class="col-md-3 col-md-offset-3">
            <select name="cate_search" required="required" id="select_cate_search" class="form-control selected2">
              <option value="all">All</option>
              <option value="0">None</option>
              <?php cate_parent($cates); ?>
            </select>
          </div>
          <div class="col-md-6">
            <div class="col-md-6">
              <input type="text"  onkeyup="formatNumBerKeyUp(this)" class="form-control" name="price_from" placeholder=" Price from...">
            </div>
            <div class="col-md-6">
              <input type="text" onkeyup="formatNumBerKeyUp(this)" class="form-control" name="price_to" placeholder=" Price to...">
            </div>
          </div>
        </div>

        <!--search form-->
        <hr style="boder:0.5px solid #fff">
        <div class="card-body" id="pro_search">
          <table id="table_pro" class="table table-striped table-bordered table_pro">
            <thead>
              <tr>
                <th><input type="checkbox" name="check_all"></th>
                <th>Image</th>
                <th>Name</th>
                <th>Price In</th>
                <th>Price Sale</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach($products as $p): 
              $supplier = '';
              $sup = $m_sup->read_supply_by_id($p->sup_id);
              if(!empty($sup)) {
                $supplier = $sup->name;
              }
              $size = json_decode($p->size);
              $disable_edit_quantity = '';
              $size_name = '[';
              if(count($size) != 0) {
                $disable_edit_quantity = 'disabled';
                foreach ($size as $key => $value) {
                  $size_name .= $key .' - ';
                }
              }
              $size_name .= ']';


              ?>
              <tr class="row_pro_<?php echo $p->id?>">
                <td><input type="checkbox" name="check_products[]" value="<?php echo $p->id?>"></td>
                <td><img src="public/images/<?php echo $p->image?>" width="150px"></td>
                <td><?php echo $p->name?></td>
                <td align="right"><?php echo number_format($p->price_in,2)?></td>
                <td align="right"><?php echo number_format($p->price,2)?></td>
                <td><?php echo $p->cate_name?></td>
                <td><?php echo $supplier?></td>
                <td><?php echo $p->quantity?></td>
                <td><?php echo $size_name?></td>
                <td>
                 <div class="dropdown">
                   <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-dot-circle-o"></i> Action
                   </button>
                   <div class="dropdown-menu" style="position: absolute;transform: translate3d(0px, 38px, 0px);top: 35px;left: 0px;will-change: transform;">
                    <?php if(count($size) > 0) {?>
                    <a class="dropdown-item badge badge-warning" data-index="<?php echo $p->id?>"  href="#edit_size" data-toggle="modal" data-proid="<?php echo $p->id?>" data-name="<?php echo $p->name?>"><i class="fa fa-trash-o"></i> View Detail Size</a>
                    <?php }?>
                    <?php if($m_per->check_permission('edit_product') ==  1) { ?>
                    <a class="dropdown-item  badge badge-primary" href="products_edit.php?id=<?php echo $p->id?>"><i class="fa fa-edit"></i> Edit</a>
                    <a class="dropdown-item badge badge-success edit_sub_img" data-name="<?php echo $p->name?>" data-proid="<?php echo $p->id?>"   data-toggle="modal" href="#edit_sub_image"><i class="fa fa-retweet"></i> Edit Sub Image</a>
                    
                    
                    <?php } else {?> <!--end if permission-->
                    <button class="dropdown-item  badge badge-primary" disabled><i class="fa fa-edit"></i> Edit</button>
                    <button class="dropdown-item badge badge-success" disabled><i class="fa fa-retweet"></i> Edit Sub Image</button>
                    
                    <?php }?>

                    <?php if($m_per->check_permission('delete_product') == 1) {?>
                    <?php if(count($size) > 0) { ?>
                    <a class="dropdown-item badge badge-danger" href="#destroy_product_size" data-toggle="modal" data-index="<?php echo $p->id?>" data-proid="<?php echo $p->id?>" data-name="<?php echo $p->name?>"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Destroy Product</a>
                    <?php } else {?>
                      <a class="dropdown-item badge badge-danger" href="#edit_quantity" data-toggle="modal" data-index="<?php echo $p->quantity?>" data-proid="<?php echo $p->id?>" data-name="<?php echo $p->name?>"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Destroy Product</a>
                    <?php }?>
                    <a class="dropdown-item badge badge-danger delete_pro" data-index="<?php echo $p->id?>"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> Delete</a>


                    <?php } else {?>
                    <button class="dropdown-item badge badge-success " disabled ><i class="fa fa-retweet"></i> Delete</button>
                    <?php }?>

                  </div>
                </div>
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

<script>
  $(document).ready(function(){
    $('.table_pro').DataTable({
            // "aaSorting":[[2,"asc"]]
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
          })
  })
</script>


<!--Delete group-->
<script>
  var checked = [];
  $(document).on('click','input[name=check_all_pro]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_pro[]"]').each(function(i,n){
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
      $('input[name="check_pro[]"]').each(function(i,n){
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
  $(document).on('click','input[name="check_pro[]"]',function(){
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
  $(document).on('click','button[name=delete_pro]',function(){
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
          if(data.trim() == 'success'){
            alert('Successfully')
            window.location.reload(); 
          }else if(data.trim() == 'parent_error') {
            alert('this cate has sub-cate!!! please delete sub-cate first');
          }
        }

      })
    } 

  })
  $(document).on('click','.delete_pro',function(){
    if(confirm('Are you are? Data wont backup again')) {
      id = $(this).data('index');
      $.ajax({
        type:'POST',
        url : "ajax.php",
        cache: false,
        data: {'id':id,'delete_pro':'OK'},
        success: function(data,status) {
          if(data.trim() == "permission") {
            console.log("permission");
            alert("You dont have permission to do this action")
          } else if(data.trim() != "") {
            console.log("success");
            $('#pro_search').html(data);
            $('.table_pro').DataTable();
          } 
        }
      })
    }
  })
</script>
<!--Delete group-->

<!--Search-->
<script type="text/javascript">
  // function delete_pro(id){
  //   if(confirm('Are you are? Data wont backup again')) {
  //     $.ajax({
  //       type:'POST',
  //       url : "ajax.php",
  //       cache: false,
  //       data: {'id':id,'delete_pro':'OK'},
  //       success: function(data,status) {
  //         if(data.trim() == "permission") {
  //           console.log("permission");
  //           alert("You dont have permission to do this action")
  //         } else if(data.trim() != "") {
  //           console.log("success");
  //           $('#pro_search').html(data);
  //           $('.table_pro').DataTable();
  //         } 
  //       }
  //     })
  //   }
  // }

  $('input[name=name_search], input[name=price_from], input[name=price_to]').on('keyup',function(){
    var name = $('input[name=name_search').val();
    var price_from = $('input[name=price_from]').val();
    var price_to = $('input[name=price_to]').val();
    var cate = $('select[name=cate_search]').val();

    $.ajax({
      type:'POST',
      url: 'ajax.php',
      cache: false,
      data: {'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_pro':'OK'},
      success: function(data,status) {
        $('#pro_search').html(data);
        $('.table_pro').DataTable();
      }
    })
  })
  $(document).ready(function(){


    $('select[name=cate_search]').on('change',function(){
      var name = $('input[name=name_search').val();
      var price_from = $('input[name=price_from]').val();
      var price_to = $('input[name=price_to]').val();
      var cate = $('select[name=cate_search]').val();

      $.ajax({
        type:'POST',
        url: 'ajax.php',
        cache: false,
        data: {'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_pro':'OK'},
        success: function(data,status) {
          $('#pro_search').html(data);
          $('.table_pro').DataTable();
        }
      })
    })
  })

  //gửi thông tin quantity qua modal


  $('#edit_quantity').on('show.bs.modal', function(e) {
    quantity = $(e.relatedTarget).data('index');
    proid = $(e.relatedTarget).data('proid');
    name = $(e.relatedTarget).data('name');
    $(e.currentTarget).find('input[name="quantity"]').val(quantity);
    $(e.currentTarget).find('input[name="id_pro"]').val(proid);
    $(e.currentTarget).find('#name_quantity_edit').html(name);

  })

    //Load list destroy product
    $('#list_destroy_product').on('show.bs.modal',function(e){

      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'list_destroy_products':'OK'},
        success:function(data){
          $(e.currentTarget).find('#table_destroy_products').html(data);
        }
      })
    })
   //gửi thông tin qua modal edit sub images
   $('#edit_sub_image').on('show.bs.modal', function(e) {
     var userid = $(e.relatedTarget).data('proid');
     var name = $(e.relatedTarget).data('name');

     $(e.currentTarget).find('input[name="id_pro"]').val(userid);
     $(e.currentTarget).find('#old_image').html('');
     $(e.currentTarget).find('.sub-image').html('');
     $(e.currentTarget).find('#name_edit_sub').html(name);
     $.ajax({
      type:'POST',
      url : 'ajax.php',
      cache:false,
      data:{'id':userid,'edit_sub_image':'OK'},
      dataType:'JSON',
      success:function(data,status){
       var html = '';

       if(data == '') {
        // window.location.reload();
      } else {
        $.each(data,function(index,v){

          html += ' <div class="col-md-6">'
          html += '   <div class="col-md-11" style="margin-top: 15px; margin-bottom: 15px"><img src="public/images/'+v+'" class="" width="130px"><a style="width: 30px; height: 30px; padding:6px 0; border-radius: 15px; text-align: center;font-size: 12px; line-height: 1.42857; position: absolute; left: 131px; top: 0" class="btn btn-danger btn-circle icon_del del_sub_image"><i class="fa fa-times"></i></a></div>';
          html += '<input type="hidden" value="'+v+'" name="old_sub_image[]">'
          html += '</div>';
        });
        $(e.currentTarget).find('#old_image').html(html);
      }


    }
  });
   });

//gửi thông tin qua modal edit size
$('#edit_size').on('show.bs.modal', function(e) {
 var id = $(e.relatedTarget).data('proid');
 var name = $(e.relatedTarget).data('name');
 $(e.currentTarget).find('input[name="id_pro"]').val(id);
 $(e.currentTarget).find('#name_edit').html(name);


 $.ajax({
  type:'POST',
  url : 'ajax.php',
  cache:false,
  data:{'id':id,'edit_size':'OK'},
  dataType:'JSON',
  success:function(data,status){
   var html = '';
   $.each(data,function(index,v){
    var xs='';
    var s='';
    var m='';
    var l='';
    var xl='';
    var xxl='';
    var xxxl='';
    if(index == "XS") xs = 'selected';
    if(index == "S") s = 'selected';
    if(index == "M") m = 'selected';
    if(index == "L") l = 'selected';
    if(index == "XL") xl = 'selected';
    if(index == "2XL") xxl = 'selected';
    if(index == "3XL") xxxl = 'selected';
    html += '  <div class="row form-group">'
    html += '  <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>'
    html += '  <div class="col-md-4">'
    html += '<input type="text" readonly value = "'+index+'" required="required" id="text-input" onkeypress="return isNumberKey(event)" name="quantity[]" class="form-control">'
    // html += ' <select name="size[]" class="form-control" id="select">';
    // html += '<option '+xs+' value="XS">XS</option>';
    // html += '<option '+s+'  value="S">S</option>';
    // html += '<option '+m+'  value="M">M</option>';
    // html += '<option '+l+'  value="L">L</option>';
    // html += '<option '+xl+'  value="XL">XL</option>';
    // html += '<option '+xxl+'  value="2XL">2XL</option>';
    // html += '<option '+xxxl+'  value="3XL">3XL</option>';
    // html += '</select>';
    html += ' </div>';
    html += '<div><label for="text-input" class=" form-control-label">Quantity:</label></div>';
    html += '<div class="col-md-4"><input type="text" readonly value = "'+v+'" required="required" id="text-input" onkeypress="return isNumberKey(event)" name="quantity[]" class="form-control"></div>';
    // html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
    html += ' </div>';
  });
   $('#add-size').html(html);

 }
});
});

$('#destroy_product_size').on('show.bs.modal', function(e) {
 var id = $(e.relatedTarget).data('proid');
 var name = $(e.relatedTarget).data('name');
 $(e.currentTarget).find('input[name="id_pro"]').val(id);
 $(e.currentTarget).find('#name_edit').html(name);

 $.ajax({
  type:'POST',
  url : 'ajax.php',
  cache:false,
  data:{'id':id,'edit_size':'OK'},
  dataType:'JSON',
  success:function(data,status){
   var html = '';
   $.each(data,function(index,v){
    var xs='';
    var s='';
    var m='';
    var l='';
    var xl='';
    var xxl='';
    var xxxl='';
    if(index == "XS") xs = 'selected';
    if(index == "S") s = 'selected';
    if(index == "M") m = 'selected';
    if(index == "L") l = 'selected';
    if(index == "XL") xl = 'selected';
    if(index == "2XL") xxl = 'selected';
    if(index == "3XL") xxxl = 'selected';
    html += '  <div class="row form-group">'
    html += '  <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>'
    html += '  <div class="col-md-4">'
    html += '<input type="text" readonly value = "'+index+'" required="required" id="text-input" onkeypress="return isNumberKey(event)" name="quantity[]" class="form-control">'
    // html += ' <select name="size[]" class="form-control" id="select">';
    // html += '<option '+xs+' value="XS">XS</option>';
    // html += '<option '+s+'  value="S">S</option>';
    // html += '<option '+m+'  value="M">M</option>';
    // html += '<option '+l+'  value="L">L</option>';
    // html += '<option '+xl+'  value="XL">XL</option>';
    // html += '<option '+xxl+'  value="2XL">2XL</option>';
    // html += '<option '+xxxl+'  value="3XL">3XL</option>';
    // html += '</select>';
    html += ' </div>';
    html += '<div><label for="text-input" class=" form-control-label">Quantity:</label></div>';
    html += '<div class="col-md-4"><input type="text" readonly value = "'+v+'" required="required" id="text-input" onkeypress="return isNumberKey(event)" name="quantity[]" class="form-control"></div>';
    // html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
    html += ' </div>';
  });
   $('#destroy-product-size').html(html);

 }
});
});
</script>
<script type="text/javascript">
  var checked = [];
  $(document).on('click','input[name=check_all]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_products[]"]').each(function(i,n){
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
      $('input[name="check_products[]"]').each(function(i,n){
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

  $(document).on('click','input[name="check_products[]"]',function(){
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
  $(document).on('click','#delete_group_product',function(){
    var requestData = JSON.stringify(checked);
    console.log(requestData);
    if(requestData == '[]') {
      alert('please choose product to delete');
    }
    else if(confirm('data will not be restore\nAre you sure')){
      var requestData = JSON.stringify(checked); //gửi requrest bằng chuổi (chuyển mảng tình chuổi)
      
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'list_id':requestData,'delete_group_product':'OK'},
        success:function(data){
         if (data.trim() == 'permission') {
          alert("You dont have permission to do this action")
        } else if(data.trim() != ''){
         $('#pro_search').html(data);
         $('.table_pro').DataTable();
       }
     }

   })
    } 
    
  })



</script>
