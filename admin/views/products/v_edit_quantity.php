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
        <form method="POST" enctype="multipart/form-data" action="products_update_quantity.php">
          <input type="hidden" name="pro_id">
          Quantity
          <input type="text" required="" name="quantity" onkeypress="return isNumberKey(event)" class="form-control">
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
    if($('input[name=quantity]').val() == '') {
      alert('quantity must be required');
    } else {
      $('button[name=update_quantity').attr('type','submit');
    }
  })
</script>


