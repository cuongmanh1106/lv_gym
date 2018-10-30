

<div class="card">
  <div class="card-header badge-info">
    <h4><i class="fa fa-plus"></i> Add a user</h4>
  </div>

  <div class="error_user">
    
  </div>

  
  <div class="card-body">
    <form id="form" method="POST" enctype="multipart/form-data" action="">
  <div class="container">
    
    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">First Name:</label></div>
        <div class="col-md-4"><input type="text" required="required" id="text-input" value="<?php echo $first_name?>" name="first_name" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
         <div class="col-md-1"><label for="text-input" class=" form-control-label">Last Name:</label></div>
        <div class="col-md-4"><input type="text" required="required" id="text-input" value="<?php echo $last_name?>" name="last_name" class="form-control"></div>
        <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>
     
   <div class="row form-group">
    <div class="col col-md-1"><label for="select" class=" form-control-label">Permission:</label></div>
    <div class="col-12 col-md-10">
      <select name="permission_id" required="required" id="select" class="form-control">
         <?php foreach($permission as $v): ?>

        <option  value="<?php echo $v->id ?>"><?php echo $v->name ?></option> 
        <?php endforeach?>
      </select>
  </div>
   <div class="col-md-1">(<span style="color:red">*</span>)</div>
   
   
  </div>

 
   <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Email</label></div>
        <div class="col-md-10"><input type="email" required="required" id="text-input" value="<?php echo $email?>" name="email" class="form-control"></div>
         <div class="col-md-1" id="check_email">(<span style="color:red">*</span>)</div>
   </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Password:</label></div>
        <div class="col-md-10"><input type="password" required="required" id="text-input" value="" name="password" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Confirm Password:</label></div>
        <div class="col-md-10"><input type="password" required="required" id="text-input" value="" name="confirm_password" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Phone Number:</label></div>
        <div class="col-md-10"><input type="text" required="required" id="text-input" value="<?php echo $phone_number?>" name="phone_number" class="form-control"></div>
         <div class="col-md-1">(<span style="color:red">*</span>)</div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Address:</label></div>
        <div class="col-md-10"><input type="text" id="text-input" name="address" value="<?php echo $address?>" class="form-control"></div>
    </div>

    <div class="row form-group">
        <div class="col-md-1"><label for="text-input" class=" form-control-label">Avatar:</label></div>
        <div class="col-md-10"><input type="file" id="text-input" name="image" class="form-control"></div>
    </div>

      <div class="form-group " style="text-align: center;">
              <button  type="submit" class="btn btn-info" id="insert_user" name="insert_user"><i class="fa fa-thumbs-o-up"></i> Add</button>
              <button type="button" class="btn btn-danger " onclick="window.location='user_list.php'" name="reset"><i class="fa fa-reply"></i> Back</button>
            </div>

  
  </div>

             
        </form>
  </div>
</div>

<script type="text/javascript">
  $('#insert_user').on('click',function(){
    var html = '';
    var flag = true;
    html += ' <ul  class="alert alert-danger">';
    if($('input[name=first_name]').val() == ''){
      flag = false;
      $('input[name=first_name]').css('border',"1px solid red");
      html += '<li>First name is required</li>';
    }  else {
      $('input[name=first_name]').css('border',"1px solid #ced4da");
    }
    if($('input[name=last_name]').val() == ''){
      flag = false;
      $('input[name=last_name]').css('border',"1px solid red");
      html += '<li>Last name is required</li>';
    }  else {
      $('input[name=last_name]').css('border',"1px solid #ced4da");
    }
    if($('input[name=email]').val() == ''){
      flag = false;
      $('input[name=email]').css('border',"1px solid red");
      html += '<li>Email name is required</li>';
    }  else {
      $('input[name=email]').css('border',"1px solid #ced4da");
    }
    if($('input[name=password]').val() == ''){
      flag = false;
      $('input[name=password]').css('border',"1px solid red");
      html += '<li>Password is required</li>';
    }  else {
      $('input[name=password]').css('border',"1px solid #ced4da");
    }
    if($('input[name=confirm_password]').val() == ''){
      flag = false;
      $('input[name=confirm_password]').css('border',"1px solid red");
      html += '<li>Confirm password is required</li>';
    }  else {
      $('input[name=confirm_password]').css('border',"1px solid #ced4da");
    }
    if($('input[name=phone_number]').val() == ''){
      flag = false;
      $('input[name=phone_number]').css('border',"1px solid red");
      html += '<li>Phone is required</li>';
    }  else {
      $('input[name=phone_number]').css('border',"1px solid #ced4da");
    }
    if($('input[name=confirm_password]').val() != $('input[name=password]').val()){
      flag = false;
      html += '<li>Wrong confirm password</li>';
    }  
    html += "</ul>";

    if(flag) {
     $('button[name="insert_user"]').attr("type", "submit");
    } else {
       $('.error_user').html(html);
    }
  })

  $('input[name=first_name]').on('change',function(){
    if($('input[name=first_name]').val() == ''){
      $('input[name=first_name]').css('border',"1px solid red");
    }  else {
      $('input[name=first_name]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=last_name]').on('change',function(){
    if($('input[name=last_name]').val() == ''){
      $('input[name=last_name]').css('border',"1px solid red");
    }  else {
      $('input[name=last_name]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=password]').on('change',function(){
    if($('input[name=password]').val() == ''){
      $('input[name=password]').css('border',"1px solid red");
    }  else {
      $('input[name=password]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=confirm_password]').on('change',function(){
    if($('input[name=confirm_password]').val() == ''){
      $('input[name=confirm_password]').css('border',"1px solid red");
    }  else {
      $('input[name=confirm_password]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=phone_number]').on('change',function(){
    if($('input[name=phone_number]').val() == ''){
      $('input[name=phone_number]').css('border',"1px solid red");
    }  else {
      $('input[name=phone_number]').css('border',"1px solid #ced4da");
    }
  })


</script>

<script>
  $(document).ready(function(){
    $('input[name=email]').on('change',function(){
      email = $('input[name=email]').val();
      var html = '';
      $.ajax({
        type:"POST",
        url:"ajax.php",
        data:{'email':email,'check_email':'OK'},
        success:function(data) {
          console.log(data);
          if(data.trim() == "ok"){
            html = '<img src="public/images/icons/tick_circle.png">';
            $('input[name=email]').css('border',"1px solid #ced4da");
            
          } else if(data.trim() == "exist") {
            html = '<img src="public/images/icons/cross_circle.png">';
            $('input[name=email]').css('border',"1px solid red");
          }
          console.log(html);
          $('#check_email').html(html);
        }
      })
    })
  })
</script>


