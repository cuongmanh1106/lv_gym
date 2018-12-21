<div id="add_stock" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header  badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-plus MarginRight-10"></i>
        Create a new Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form id="form" method="POST" action="stock_receipt_add.php">

         <div class="row form-group">
          <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Supplier</label></div>
          <div class="col-12 col-md-9">
            <select name="sup_id" class="form-control">
              <?php foreach($sups as $s) {?>
              <option value="<?php echo $s->id?>"><?php echo $s->name?></option>
              <?php }?>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
          <div class="col-12 col-md-9"><textarea class="ckeditor description_stock"  name="description_stock" id="des_stock" required="required" rows="9" placeholder="Content..." class="form-control"></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer ">

        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fa fa-reply icon"></i> Back</button>
          <button type="submit" name="add_stock" class="btn btn-info">
            <i class="fa fa-thumbs-up icon"></i> Save</button>
          </div>
        </form>
      </div>

    </div>
  </div>
  <script type="text/javascript">
    $('button[name=reset]').on('click',function(){
      $('input[name=name]').val('');
      $('#editor1').val('');

    })
    // $('button[name=add_stock]').on('click',function(){
    //   var description = $('#des_stock').val();
    //   console.log($('textarea[name=description_stock]').val());
    //   console.log($('textarea[name=description_stock]').text());
    //   console.log($('textarea[name=description_stock]').html());
    //   console.log($('.description_stock').val());
    //   console.log($('.description_stock').text());
    //   console.log($('.description_stock').html());

    //   console.log(description);
    //   // $.ajax({
    //   //   type:'POST',
    //   //   url:'ajax.php',
    //   //   data:{'description':description,'add_stock':'OK'},
    //   //   success:function(data) {
    //   //     // window.location.reload();
    //   //   }
    //   // })
    // })
  </script>

