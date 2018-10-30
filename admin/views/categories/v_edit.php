
<?php require("include/report.php");?>
<div class="card">
  <div class="card-header   badge-info">
  	<h5 class="card-title"> <i class="fa fa-edit"></i> Edit a Category</h5>
  
  </div>
  
  <div class="card-body">
    <form id="form" method="POST" >
             <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" value="<?php echo $cate->name ?>" class="form-control"></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="select" class=" form-control-label">Parent</label></div>
                <div class="col-12 col-md-9">
                  <select class="form-control selected2" name="parent">
                      <option value="0">--None--</option>
                      <?php cate_parent_edit($cates,0,"--",$cate->parent_id); ?>
                	</select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                <div class="col-12 col-md-9"><textarea class="ckeditor"  name="description" id="editor1" required="required" rows="9" placeholder="Content..." class="form-control"><?php echo $cate->description?></textarea>
              </div>
            </div>
            <div class="form-group " style="text-align: center;">
              <button  type="submit" name="edit_cate" class="btn btn-info" name=""><i class="fa fa-thumbs-o-up"></i> Update</button>
              <button type="button" class="btn btn-danger" onclick="window.location='cate_list.php'" name="reset"><i class="fa fa-reply"></i> Back</button>
            </div>
             
        </form>
  </div>
</div>