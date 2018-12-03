
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="promotion_list.php" style="color: blue">Promotions</a></li>
      <li class="breadcrumb-item"><a href="promotion_list_products?id=<?php echo $id?>" style="color: blue" aria-current="page">List Products Promotion</a></li>
      <li class="breadcrumb-item active">Select products in promotion</li>
    </ol>
  </nav>


<?php require("include/report.php");?>

<form method="POST" action="promotion_chose_products.php?id=<?php echo $id?>" >
  <input type="hidden" name="list_id" value="">
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info ">
            <strong class="card-title"><i class="fa fa-list"></i> Let choose products which you would like to reduce </strong>
            <a href="promotion_list_products.php?id=<?php echo $id?>" class="btn btn-danger"><i class="fa fa-reply"></i> Back</a>
            <button type="button" id="save_product" name="save_product" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
          </div> 
          <!--search form-->
          <div class="search" style="margin-top: 20px">
           <div class="col-md-3">
             <input type="text" class="form-control" name="name_search" placeholder=" Name...">
           </div>
           <div class="col-md-3 col-md-offset-3">
            <select name="cate_search" required="required" id="select_cate_search" class="form-control">
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
                <th>Price</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Introduce</th>
                <th>Size</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = 1; foreach($products as $p): 
              
              $supplier = '';
              $cate_name = '';
              $cate = $m_cate->read_cate_by_id($p->cate_id);
              if(!empty($cate)) {
                $cate_name = $cate->name;
              }
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
                <td align="right"><?php echo number_format($p->price,2)?></td>
                <td><?php echo $cate_name ?></td>
                <td><?php echo $supplier?></td>
                <td><?php echo $p->quantity?></td>
                <td><?php echo substr($p->intro,0,30)  ?>.....</td>
                <td><?php echo $size_name?></td>
                <td>
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
</form>
<script>
  $(document).ready(function(){
    $('.table_pro').DataTable({
            // "aaSorting":[[2,"asc"]]
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
          })
  })
</script>


<!--Search-->
<script type="text/javascript">

  $('input[name=name_search], input[name=price_from], input[name=price_to]').on('keyup',function(){
    var name = $('input[name=name_search').val();
      var price_from = $('input[name=price_from]').val();
      var price_to = $('input[name=price_to]').val();
      var cate = $('select[name=cate_search]').val();
      var id = '<?php echo $id ?>';

      $.ajax({
        type:'POST',
        url: 'ajax.php',
        cache: false,
        data: {'id':id,'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_pro_promotion':'OK'},
        success: function(data,status) {
          $('#pro_search').html(data);
          $('.table_pro').DataTable();
        }
      })
  })

    $(document).on('change','select[name=cate_search]',function(){
      var name = $('input[name=name_search').val();
      var price_from = $('input[name=price_from]').val();
      var price_to = $('input[name=price_to]').val();
      var cate = $('select[name=cate_search]').val();
      var id = '<?php echo $id ?>';

      $.ajax({
        type:'POST',
        url: 'ajax.php',
        cache: false,
        data: {'id':id,'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_pro_promotion':'OK'},
        success: function(data,status) {
          $('#pro_search').html(data);
          $('.table_pro').DataTable();
        }
      })
    })

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
    var requestData = JSON.stringify(checked);
    $('input[name=list_id]').val(requestData);
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
    var requestData = JSON.stringify(checked);
    $('input[name=list_id]').val(requestData);

  })

  $(document).on('click','#save_product',function(){
    var data = JSON.stringify(checked);
    if(data == "[]") {
      alert("Please choose products to do this action!!!");
    } else {
      $(this).attr('type','submit');
    }
  })




</script>
