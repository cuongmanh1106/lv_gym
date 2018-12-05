<div id="add_cate" class="modal fade" role="dialog">
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

        <form id="form" method="POST" action="cate_add.php">
         <div class="row form-group">
          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label><sup>*</sup></div>
          <div class="col-12 col-md-9"><input type="text" required="required" id="text-input" name="name" class="form-control"></div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="select" class=" form-control-label">Parent</label></div>
          <div class="col-12 col-md-9">
            <select name="parent" required="required" id="select" class="form-control">
              <option value="0">--None--</option>
              <?php cate_parent($cates)?>
            </select>
          </div>
        </div>

        <div class="row form-group">
          <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
          <div class="col-12 col-md-9"><textarea class="ckeditor"  name="description" id="editor1" required="required" rows="9" placeholder="Content..." class="form-control"></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer ">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa fa-reply icon"></i> Back</button>
            <button type="submit" name="add_cate" class="btn btn-info">
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
  </script>

