<div id="list_destroy_product" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit MarginRight-10"></i>
        List Destroy Products</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="table_destroy_products"></td>
          
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
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


