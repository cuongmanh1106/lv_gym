
<?php echo $total?>-<?php echo $count?>-<?php echo $time ?>---
<?php 
$price = $cart["price"];
$front = "$";
$back = "";
if(isset($_SESSION["vn"])) {
  $front = "";
  $back = " VND"; 
  $price = $cart["price"]*$_SESSION["vn"];
  
} 
?>
<tr id="<?php echo $time ?>"> 
  <td><img src="admin/public/images/<?php echo  $product->image ?>" width="70px"></td>
  <td width="20%" ><?php echo  $product->name ?></td>
  <td align="right"><?php echo $front ?> <?php echo  number_format($price, 2)?><?php echo $back?></td>
  <td width="10%"><input type="number"  onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo  $cart["qty"] ?>" name="qty_checkout"></td>
  <td>
    <?php if($cart["size"] != 'none') {?>
      <select class="form-control" name="size_update">
        <?php foreach($sizes as $k=>$s): ?>
          <?php if($s != 0) {?>
            <option <?php echo ($cart["size"] == $k)?'selected':'' ?> value="<?php echo $k ?>"><?php echo $k ?></option>
            <?php } ?> <!--end if $s != 0-->

            <?php endforeach ?><!--end for-->
          </select>
          <?php } else {?><!--end if $cart["size"] != 'none'-->
          <select class="form-control hidden" name="size_update">
            <option value="none">option</option>
          </select> 
          <p><?php echo  $cart["size"] ?></p>
        <?php } ?>

      </td>
      <td align="right"><span class="sub-total"><?php echo $front?><?php echo  number_format($price*$cart["qty"],2)?><?php echo "</br>".$back?></span></td>
      <td>
        <a data-index = "<?php echo  $time ?>" class="btn btn-info update_cart" href="javascript:void(0)"><i class="fa fa-edit"></i> Update</a>
        <input type="hidden" value="<?php echo  $cart["id"] ?>" name="pro_id">
        <a class="btn btn-danger delete_cart"  data-index = "<?php echo  $time ?>" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
      </td>
    </tr>
                <!-- <input  -->