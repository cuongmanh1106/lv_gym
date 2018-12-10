<div id="edit_quantity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit MarginRight-10"></i>
        Edit Size( <span id="name_quantity_edit"></span> )</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="err_destroy_qty"></div>
        <form method="POST" enctype="multipart/form-data" action="product_destroy.php">
          <input type="hidden" name="id_pro">
          <input type="hidden" name="destroy_quantity" value="OK">
          Quantity
          <input readonly type="text" required="" name="quantity" onkeypress="return isNumberKey(event)" class="form-control">
          <hr>
          <h5>Quantity destroy</h5>
          <hr>
          <input type="text" required="" name="quantity_destroy" onkeypress="return isNumberKey(event)" class="form-control">
          <div class="modal-footer">
            <button type="button" style="text-align: center;" name="update_quantity" class="btn btn-info">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
      
    </div>

  </div>
</div>
<script type="text/javascript">
  $(document).on('click','button[name=update_quantity]',function(){
    check = true;
    quantity_destroy = $('input[name=quantity_destroy]').val();
    quantity = $('input[name=quantity]').val();
     var html = '<ul  id="error" class="alert alert-danger">';
    if($('input[name=quantity_destroy]').val() == '') {
      check = false;
      html += '<li>quantity is required</li>';
    } 
    if(parseInt(quantity_destroy) > parseInt(quantity) ) {
      check = false;
      html += '<li>quantity destroy must be lower than product quantity</li>';
    }
    if(check){
      $('button[name=update_quantity').attr('type','submit');
    } else {
      html += '</ul>';
      $('#err_destroy_qty').html(html);
    }
    
  })
</script>


