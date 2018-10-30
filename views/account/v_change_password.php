<div id="change_password" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17a2b8">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left; color:#fff; font-weight: bold">
          <i class="fa fa-plus MarginRight-10"></i>
        Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        
    <div class="edit_password"></div>
        
           <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">Password:</label></div>
              <div class="col-md-9"><input type="password" required="required" id="text-input" value="" name="password" class="form-control"></div>
              <div class="">(<span style="color:red">*</span>)</div>
          </div>
            
          <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">New Password:</label></div>
              <div class="col-md-9"><input type="password" required="required" id="text-input" value="" name="new_password" class="form-control"></div>
              <div class="">(<span style="color:red">*</span>)</div>
          </div>
           <div class="row form-group">
              <div class="col-md-2"><label for="text-input" class=" form-control-label">Confirm Password:</label></div>
              <div class="col-md-9"><input type="password" required="required" id="text-input" value="" name="conf_new_password" class="form-control"></div>
              <div class="">(<span style="color:red">*</span>)</div>
          </div>
          

      </div>

      <div class="modal-footer">
        <button type="button" name="change_password" id="change_password" style="text-align: center;" class="btn btn-info">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
</div>

</div>

</div>
</div>
<script type="text/javascript">
  $('#change_password').on('click',function(){
    html = '<ul class="alert alert-danger" >';
    flag = true;
    if($('input[name=password]').val() == '') {
      html += '<li>Password is required</li>';
      flag = false;
    }
    if($('input[name=new_password]').val() == '') {
      html += '<li>New password  is required</li>';
      flag = false;
    }
    if($('input[name=conf_new_password]').val() == '') {
      html += '<li>Confirm password is required</li>';
      flag = false;
    }
    password = $('input[name=password]').val();
    new_password = $('input[name=new_password]').val();
    conf_new_password = $('input[name=conf_new_password]').val();
    if(new_password != conf_new_password){
      html += '<li>Wrong confirm password</li>';
      flag = false;
    }
    if(flag) {

      $.ajax({

        type:"POST",
        url: "ajax.php",
        data:{'password':password,'new_password':new_password,'change_password':'OK'},
        success: function(data){
          if(data.trim() == 'success') {
            alert("Success");
            window.location.reload();
          } else if(data.trim() == 'error_password') {
            html += '<li>Wrong password</li>';
            html += '</ul>';
            $('.edit_password').html(html);
          }

        }
      });
    } else {
      html += '</ul>';
      $('.edit_password').html(html)
    }
   

  })
</script>
