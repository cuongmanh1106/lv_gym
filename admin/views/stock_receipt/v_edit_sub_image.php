<div id="edit_sub_image" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header  badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit MarginRight-10"></i>
          Edit Sub Image( <span id="name_edit_sub"></span> )</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" action="products_update_sub.php">
            <input type="hidden" name="stock_id" value="<?php echo $stock_id ?>">
            <input type="hidden" name="id_pro" value="">
            <div id="old_image"></div>

            <div class="clearfix"></div>
            <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-image"><i class="fa fa-plus"></i> Add sub-image</a>
            <hr>
            <br>
            <div class="sub-image">


            </div>

            <div class="modal-footer">
              <button type="submit" style="text-align: center;" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-reply"></i> Close</button>
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

    $('#add-sub-image').on('click',function(){
      var html = '';
      html += '<div class="row form-group">';
      html += '<div class="col-md-11"><input type="file" id="text-input" name="sub_image[]" class="form-control"></div>';
      html += '<button type="button" class="close close-add-image" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
      html += '</div>';
      $('.sub-image').append(html);
    });

    $(document).on('click', '.del_sub_image', function () {
      $(this).parent().parent().remove();
    })

    $(document).on('click','.close-add-image',function(){
      $(this).parent().remove();
    })
  </script>

