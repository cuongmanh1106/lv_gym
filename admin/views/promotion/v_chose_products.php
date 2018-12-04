
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="promotion_list.php" style="color: blue">Promotions</a></li>
      <li class="breadcrumb-item"><a href="promotion_list_products?id=<?php echo $id?>" style="color: blue" aria-current="page">List Products Promotion</a></li>
      <li class="breadcrumb-item active">Update price for promotion</li>
    </ol>
  </nav>

<?php require("include/report.php");?>

<form method="POST" action="promotion_save_chose_products.php?id=<?php echo $id ?>" >
  <input type="hidden" name="list_id" value="">
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info ">
            <strong class="card-title"><i class="fa fa-list"></i> List Chose Products Promotion </strong>
            <a href="promotion_list_products.php?id=<?php echo $id?>" class="btn btn-danger"><i class="fa fa-reply"></i> Back</a>
            <button type="button"  id="save_product" name="save_product" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
          </div> 
          <!--search form-->
          <div class="search" style="margin-top: 20px">
          
        </div>  
        <form method="POST" action="#">
        <!--search form-->
        <hr style="boder:0.5px solid #fff">
        <div class="card-body" id="pro_search">
          <table id="table_pro" class="table table-striped table-bordered table_pro">
            <thead>
              <tr>
                <th><input type="checkbox" name="check_all"></th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price In</th>
                <th>Price Sale</th>
                <th>Promotion Price</th>
                <th>Percent</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = 1; foreach($products as $p):
              $cate_name = '';
              $cate = $m_cate->read_cate_by_id($p->cate_id);
              if(!empty($cate)) {
                $cate_name = $cate->name;
              } 
              
              ?>
              <tr class="row_pro_<?php echo $p->id?>">
                <input name="pro_id[]" type="hidden" value="<?php echo $p->id ?>">
                <input type="hidden" name="price" value="<?php echo $p->price?>">
                <input type="hidden" name="price_in" value="<?php echo $p->price_in?>">
                <td><input type="checkbox" name="check_products[]" value="<?php echo $p->id?>"></td>
                <td><img src="public/images/<?php echo $p->image?>" width="150px"></td>
                <td><?php echo $p->name?></td>
                <td><?php echo $cate_name?></td>
                <td align="right"><?php echo number_format($p->price_in,2)?></td>
                <td align="right"><?php echo number_format($p->price,2)?></td>
                <td><input type="text"  onkeyup="formatNumBerKeyUp(this)" class="form-control" name="promotion_price[]" value=""></td>
                <td><input type="number" min="1" max="99" name="percent"></td>
                <td style="display: flex;justify-content: center;">
                  <button type="button" class="close close-product" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="color:red" >x</span>
                  </button>
              </td>
            </tr>
            <?php $i++; endforeach ?>
          </tbody>
        </table>
      </div>
    </form>
    </div>
  </div>


</div>
</div><!-- .animated -->
</div><!-- .content -->
</form>
<script>
  // $(document).ready(function(){
  //   $('.table_pro').DataTable({
  //           // "aaSorting":[[2,"asc"]]
  //           "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
  //         })
  // })
</script>


<!--Search-->
<script type="text/javascript">

  $(document).on('change','input[name=percent]',function() {
    per = $(this).val();
    if(per > 1 && per < 100 ) {
      var price = $(this).parent().parent().find('input[name=price]').val();
      price_in = $(this).parent().parent().find('input[name=price_in]').val();
      var price_promotion = parseFloat(price*(1-per/100));
      if(parseFloat(price_promotion) > parseFloat(price_in)) {
        $(this).parent().parent().find('input[name="promotion_price[]"]').val(price_promotion);
      } else {
        alert("Promotion price must be higher than price in and lower than price sale");
        $(this).parent().parent().find('input[name="promotion_price[]"]').val('');
      }

    } else {
      alert("Illigel Percent");
      $(this).parent().parent().find('input[name="promotion_price[]"]').val('');
    }
  })

  $(document).on('change','input[name="promotion_price[]"]',function(){
    price_promotion = $(this).val();
    price = $(this).parent().parent().find('input[name=price]').val();
    price_in = $(this).parent().parent().find('input[name=price_in]').val();

    if(parseFloat(price_promotion) <  parseFloat(price) && parseFloat(price_promotion) > parseFloat(price_in) && price_promotion > 0) {
      var per = parseInt(100 - price_promotion/price*100);
      $(this).parent().parent().find('input[name=percent]').val(per);
    } else {
      alert("Promotion price must be higher than price in and lower than price sale");
      $(this).parent().parent().find('input[name="promotion_price[]"]').val('');
    }
  })
  $(document).on('click','.close-product',function(){
    $(this).parent().parent().remove();
  })

  $('input[name=name_search], input[name=price_from], input[name=price_to]').on('keyup',function(){
    var name = $('input[name=name_search').val();
    var price_from = $('input[name=price_from]').val();
    var price_to = $('input[name=price_to]').val();
    var cate = $('select[name=cate_search]').val();

    $.ajax({
      type:'POST',
      url: 'ajax.php',
      cache: false,
      data: {'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_chose_promotion':'OK'},
      success: function(data,status) {
        $('#pro_search').html(data);
        $('.table_pro').DataTable();
      }
    })
  })

    $(document).on('change','select[name=cate_search]',function(){
      alert(1);
      var name = $('input[name=name_search').val();
      var price_from = $('input[name=price_from]').val();
      var price_to = $('input[name=price_to]').val();
      var cate = $('select[name=cate_search]').val();

      $.ajax({
        type:'POST',
        url: 'ajax.php',
        cache: false,
        data: {'name':name, 'price_from':price_from, 'price_to':price_to, 'cate':cate,'search_chose_promotion':'OK'},
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

  $(document).on('click','button[name=save_product]',function(){
    var promotion_price = $('input[name="promotion_price[]"]');
    html = "";
    flag = true;
    $.each(promotion_price,function(i,v){
      if($(v).val() == '') {
        flag = false;
        return false;
      }
    })

    if(flag) {
      $(this).attr('type','submit');
    } else {
      html += '<div class = "alert alert-danger">Please fill all Promotion Price</div> ';
      $('.search').html(html);
    }
    
  })




</script>
