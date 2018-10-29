<?php @session_start();
  ini_set('display_errors', 0);

 ?>
<div id="checkout_cart" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17a2b8">
        <h4 style="text-align: left; color:#fff; font-weight: bold"><i class="fa fa-shopping-cart"> </i> Your Shopping cart</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <?php
        $count = 0;
        $carts = $_SESSION["cart"];
        $total = 0;
        $count = count($carts);
        ?>

        <div class="">
          <div class="">
            <div class=""><h3 style="text-align: center;">Your shopping cart</h3></div>
            <div class="">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody id="cart_show">
                 <?php foreach($carts as $key=>$c) {?>
                 <?php 
                 $m_tmp_pro = new M_products();
                 $pd = $m_tmp_pro->read_product_by_id($c["id"]); 
                 $sizes = json_decode($pd->size);
                 $total += $c["qty"]*$c["price"];
                 ?>
                 <tr id="<?php echo $key ?>"> 
                  <td><img src="admin/public/images/<?php echo  $pd->image ?>" width="70px"></td>
                  <td width="20%" ><?php echo  $pd->name ?></td>
                  <td>$ <?php echo  number_format($pd->price, 2)?></td>
                  <td width="10%"><input type="number" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo  $c["qty"] ?>" name="qty_checkout"></td>
                  <td>
                    <?php if($c["size"] != 'none') {?>
                    <select class="form-control" name="size_update">
                      <?php foreach($sizes as $k=>$s): ?>
                      <?php if($s != 0) {?>
                      <option <?php echo ($c["size"] == $k)?'selected':'' ?> value="<?php echo $k ?>"><?php echo $k ?></option>
                      <?php } ?> <!--end if $s != 0-->
                      <?php endforeach ?><!--end for-->
                    </select>
                    <?php } else {?><!--end if $cart["size"] != 'none'-->
                    <select class="form-control hidden" name="size_update">
                      <option value="none">option</option>
                    </select> 
                    <p><?php echo  $c["size"] ?></p>
                    <?php } ?>

                  </td>
                  <td>$ <span class="sub-total"><?php echo  number_format($c["price"]*$c["qty"],2)?></span></td>
                  <td>
                    <a data-index = "<?php echo  $key ?>" class="btn btn-info update_cart" href="javascript:void(0)"><i class="fa fa-edit"></i> Update</a>
                    <input type="hidden" value="<?php echo  $c["id"] ?>" name="pro_id">
                    <a class="btn btn-danger delete_cart"  data-index = "<?php echo  $key ?>" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
                  </td>
                </tr>
                <?php } ?> <!--endforeach carts-->
              </tbody>
              <tfoot>
                <td colspan="7" align="right"><h2><b>Total:$</b> <span class="total"><?php echo $total ?></span></h2></td>
                <input type="hidden" name="check_checkout" value="<?php echo isset($_SESSION["customer"])?'1':'0' ?>">
              </tfoot>
            </table>
          </div>
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <?php if($count > 0) {?>
      <button type="button"  name="process" data-index="<?php echo  $count ?>" style="text-align: center;" class="btn btn-warning"><i class="fa fa-reply"></i> Process to buy</button>
      <?php } else {?> 
      <button disabled type="button"  name="process" data-index="<?php echo  $count ?>" style="text-align: center;" class="btn btn-warning"><i class="fa fa-reply"></i> Process to buy</button>
      <?php } ?>
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
    </div>

  </form>

</div>

</div>

</div>
</div>



<script type="text/javascript">
  $(document).ready(function(){
    
  })

  $(document).on('click','button[name=process]',function(){
    user = $('input[name=check_checkout]').val();
    console.log(user);
    count = $('button[name=process]').attr('data-index');
    if(parseInt(count) == 0) { //nếu không có sp trong giỏ thì disabled nút process to buy
      $('button[name=process]').addClass('disabled');
    }
    if(user == '0') {
      if(confirm('You must login to go on!!!')){
        window.location = 'login.php';
      }
    } else {
      window.location = 'cart_checkout.php' //process-to-buy;
    }
  })


</script>

