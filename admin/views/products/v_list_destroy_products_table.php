<table id="table_list_destroy_product" class="table table-striped table-bordered table_list_destroy_product">
  <thead>

    <tr>
     <th>#</th>
     <th>Date</th>
     <th>User</th>
     <th>Image</th>
     <th>Name</th>
     <th>Quantity</th>
     <th>Size</th>
   </tr>
 </thead>
 <tbody>

   <?php
   foreach($products as $key=>$u):
    $user_name = '';
    $user = $m_user->read_user_by_id($u->user_id);
    $product = $m_pro->read_product_by_id($u->pro_id);
    if(!empty($user)) {
      $user_name = $user->first_name ." ".$last_name;
    }    
    $size = json_decode($u->size);
    $show_size = "";
    if(count($size) > 0) {
      foreach($size as $k=>$v) {
        $show_size .= $k ." => ".$v;
      }
    } else {
      $show_size = 'none';
    }
    ?>
    <tr id="">
      <td><?php echo $key + 1 ?></td>
      <td><?php echo $u->created_at?></td>
      <td><?php echo $user_name?></td>
      <td><img src="public/images/<?php echo $product->image?>" width="60px" ></td>
      <td><?php echo $product->name ?></td>
      <td><?php echo $u->quantity ?></td>
      <td><?php echo $show_size?></td>
</tr>
<?php endforeach?>
</tbody>
</table>

<script type="text/javascript">
  $(document).ready(function(){
    $('.table_list_destroy_product').DataTable();
  })
</script>