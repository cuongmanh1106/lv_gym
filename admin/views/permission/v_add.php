<div id="insert_per" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4><i class="fa fa-plus"></i> Add Permission</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="permission_add.php">
          <div class="row form-group">
             <div class="col-md-2"><label for="text-input" class=" form-control-label">Name: </label></div>
             <div class="col-md-9"><input type="text" required="required" id="text-input" value="" name="name" class="form-control"></div>
             <div class="col-md-1">(<span style="color:red">*</span>)</div>
         </div>
         <div class="modal-footer">
          <button type="submit" style="text-align: center;" class="btn btn-info">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
     </form>
 </div>

</div>

</div>
</div>
<script type="text/javascript">
  $('button[name=reset]').on('click',function(){
    $('input[name=name]').val('');
    $('#editor1').val('');

})

  


</script>

