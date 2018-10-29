<div id="view_contact" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4 class="modal-title"><i class="fa fa-eye"></i> View feedback</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label>Content: </label>
        <p id="view_content"></p>
      </div>
      <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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


