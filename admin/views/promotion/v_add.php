
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="promotion_list.php" style="color: blue">List Promotions</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
  </ol>
</nav>
<?php include("include/report.php"); ?>

<div class="card">
  <div class="card-header badge-info">
    <h4><i class="fa fa-plus"></i> Add a promotion</h4>
  </div>

  <div class="error_user">

  </div>

  
  <div class="card-body">
    <form id="form" method="POST" enctype="multipart/form-data" action="">
      <div class="container">

        <div class="row form-group">
          <div class="col-md-1"><label for="text-input" class=" form-control-label">Name:</label></div>
          <div class="col-md-10"><input type="text" required="required" id="text-input" value="<?php echo $name?>" name="name" class="form-control"></div>
          <div class="col-md-1">(<span style="color:red">*</span>)</div>
        </div>

        <div class="row form-group">
          <div class="col-md-1"><label for="text-input" class=" form-control-label">Date From:</label></div>
          <div class="col-md-10"><input type="date" required="required" id="text-input" value="<?php echo $date_from?>" name="date_from" class="form-control"></div>
          <div class="col-md-1">(<span style="color:red">*</span>)</div>
        </div>

        <div class="row form-group">
          <div class="col-md-1"><label for="text-input" class=" form-control-label">Date To:</label></div>
          <div class="col-md-10"><input type="date" required="required" id="text-input" value="<?php echo $date_to?>" name="date_to" class="form-control"></div>
          <div class="col-md-1">(<span style="color:red">*</span>)</div>
        </div>

        <div class="row form-group">
          <div class="col-md-1"><label for="text-input" class=" form-control-label">Image:</label></div>
          <div class="col-md-10"><input type="file" id="text-input" value="" name="image" class="form-control"></div>
        </div>

        <div class="row form-group">
          <div class="col-md-1"><label for="text-input" class=" form-control-label">Description:</label></div>
          <div class="col-md-10"><textarea id="text-input" name="description" class="form-control ckeditor"><?php echo $description?></textarea></div>
        </div>


        <div class="form-group " style="text-align: center;">
          <button type="button" class="btn btn-danger " onclick="window.location='promotion_list.php'" name="reset"><i class="fa fa-reply"></i> Back</button>
          <button  type="button" class="btn btn-info" id="insert_promotion" name="insert_promotion"><i class="fa fa-thumbs-o-up"></i> Save</button>

        </div>


      </div>


    </form>
  </div>
</div>

<script type="text/javascript">
  $('#insert_promotion').on('click',function(){
    var html = '';
    var flag = true;
    var d = new Date();
    var date_from = new Date($('input[name=date_from]').val());
    var date_to = new Date($('input[name=date_to]').val());

    console.log(d);
    console.log(date_from);
    
    
    html += ' <ul  class="alert alert-danger">';
    if($('input[name=name]').val() == ''){
      flag = false;
      $('input[name=name]').css('border',"1px solid red");
      html += '<li>Name is required</li>';
    }  else {
      $('input[name=name]').css('border',"1px solid #ced4da");
    }
    if($('input[name=date_from]').val() == ''){
      flag = false;
      $('input[name=date_from]').css('border',"1px solid red");
      html += '<li>Date From is required</li>';
    }  else {
      $('input[name=date_from]').css('border',"1px solid #ced4da");
    }
    if($('input[name=date_to]').val() == ''){
      flag = false;
      $('input[name=date_to]').css('border',"1px solid red");
      html += '<li>Date To is required</li>';
    }  else {
      $('input[name=date_to]').css('border',"1px solid #ced4da");
    }
    if(date_from.getTime() < d.getTime()) {
      flag = false;
      html += '<li>Date must be higher than current date</li>';
    }
    if(date_from.getTime() > date_to.getTime()) {
      flag = false;
      html += '<li>Date From must be lower than Date To</li>';
    }
    html += "</ul>";

    if(flag) {
     $('button[name="insert_promotion"]').attr("type", "submit");
   } else {
     $('.error_user').html(html);
   }
 })

  $('input[name=name]').on('change',function(){
    if($('input[name=name]').val() == ''){
      $('input[name=name]').css('border',"1px solid red");
    }  else {
      $('input[name=name]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=date_from]').on('change',function(){
    if($('input[name=date_from]').val() == ''){
      $('input[name=date_from]').css('border',"1px solid red");
    }  else {
      $('input[name=date_from]').css('border',"1px solid #ced4da");
    }
  })

  $('input[name=date_to]').on('change',function(){
    if($('input[name=date_to]').val() == ''){
      $('input[name=date_to]').css('border',"1px solid red");
    }  else {
      $('input[name=date_to]').css('border',"1px solid #ced4da");
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


