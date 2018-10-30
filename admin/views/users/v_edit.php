<div id="edit_profile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit MarginRight-10"></i>
          Edit Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <div class="profile_validation"></div>
        <form method="POST" enctype="multipart/form-data" action="user_edit.php">

          <input type="hidden" name="user_id" value="<?php echo  $_SESSION["user"]->id ?>">
          <div class="row form-group">
            <div class="col-md-2"><label for="text-input" class=" form-control-label">First name:</label></div>
            <div class="col-md-9"><input type="text" required="required" id="text-input" value="<?php echo  $_SESSION["user"]->first_name ?>" name="first_name" class="form-control"></div>
            <div class="">(<span style="color:red">*</span>)</div>
          </div>
          <div class="row form-group">
            <div class="col-md-2"><label for="text-input" class=" form-control-label">Last name:</label></div>
            <div class="col-md-9"><input type="text" required="required" id="text-input" value="<?php echo  $_SESSION["user"]->last_name ?>" name="last_name" class="form-control"></div>
            <div class="">(<span style="color:red">*</span>)</div>
          </div>

          <div class="row form-group">
            <div class="col-md-2"><label for="text-input" class=" form-control-label">Phone:</label></div>
            <div class="col-md-9"><input type="text" required="required"  onkeypress="return isNumberKey(event)" maxlength="11" minlength="9" id="text-input" value="<?php echo  $_SESSION["user"]->phone_number ?>" name="phone_number" class="form-control"></div>
            <div class="">(<span style="color:red">*</span>)</div>
          </div>
          <div class="row form-group">
            <div class="col-md-2"><label for="text-input" class=" form-control-label">Address:</label></div>
            <div class="col-md-9"><input type="text"  id="text-input" value="<?php echo  $_SESSION["user"]->address ?>" name="address" class="form-control"></div>
          </div>
          <div class="row form-group">
            <div class="col-md-2"><label for="text-input" class=" form-control-label">Avatar:</label></div>
            <div class="col-md-9"><input type="file" id="text-input"  name="image" class="form-control"></div>
            <?php if($_SESSION["user"]->image != '') {?>
              <div class="col-md-2"></div>
              <div class="col-md-4" style="margin-top: 10px;"><img src="public/images/<?php echo  ($_SESSION["user"]->image != "")?$_SESSION["user"]->image:'us.png' ?>" width="150px" height="150px"></div>
              <?php }?>
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" name="update_prof" id="update_profile" style="text-align: center;" class="btn btn-info"><i class="fa fa-thumbs-up"></i> Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-reply"></i> Close</button>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>
<script type="text/javascript">
  $('#update_profile').on('click',function(){
    html = '<ul class="alert alert-danger" >';
    flag = true;
    if($('input[name=first_name]').val() == '') {
      html += '<li>First name is required</li>';
      $('input[name=first_name]').css("border","1px solid red");
      flag = false;
    } else {
      $('input[name=first_name]').css('border',"1px solid #ced4da");
    }
    if($('input[name=last_name]').val() == '') {
      html += '<li>Last name  is required</li>';
      $('input[name=last_name]').css("border","1px solid red");
      flag = false;
    } else {
      $('input[name=last_name]').css('border',"1px solid #ced4da");
    }

    if($('input[name=phone_number]').val() == '') {
      $('input[name=phone_number]').css("border","1px solid red");
      html += '<li>First name is required</li>';
      flag = false;
    } else {
      $('input[name=phone_number]').css('border',"1px solid #ced4da");
    }
    html += '</ul>';
    if(flag) {
      $('button[name="update_prof"]').attr("type", "submit");
    } else {
      $('.profile_validation').html(html);
    }

  })

  $('input[name=first_name]').on('change',function(){
    if($('input[name=first_name]').val() == '') {
      $('input[name=first_name]').css("border","1px solid red");
    } else {
      $('input[name=first_name]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=last_name]').on('change',function(){
    if($('input[name=last_name]').val() == '') {
      $('input[name=last_name]').css("border","1px solid red");
    } else {
      $('input[name=last_name]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=phone_number]').on('change',function(){
    if($('input[name=phone_number]').val() == '') {
      $('input[name=phone_number]').css("border","1px solid red");
    } else {
      $('input[name=phone_number]').css('border',"1px solid #ced4da");
    }
  })
</script>

