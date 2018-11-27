
<?php include("v_view.php"); ?>
<?php
include("include/report.php");
?>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
            <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> FeedBack</strong>
            <Button class="btn btn-danger" id="delete_group_contact"><i class="fa fa-trash-o"></i> Delete</Button>
          </div>
          
        <div class="card-body search_feedback">
         
          <table id="bootstrap-data-table" class="table table-striped table-bordered table_feedback search_cate">
            <thead>

              <tr>
                <th><input type="checkbox" name="check_all_contact"></th>
                <th>STT</th>
                <th>Customer </th>
                <th>Content</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
              foreach($contacts as $key=>$p):
              $user = $m_user->read_user_by_id($p->customer_id);
              ?>
              <tr id="">
                <td><input type="checkbox" name="check_contact[]" value="<?php echo  $p->id ?>"></td>
                <td><?php echo $key ?></td>
                <td><?php echo $user->first_name ?> <?php echo  $user->last_name ?></td>
                <td><?php echo substr($p->content,0,100) ?></td>
                <td>
                  <?php if($p->status == 0) {?>
                  <label class="badge badge-success status">New</label></td>
                  <?php } else { ?> 
                  <label class="badge badge-info">Seen</label></td>
                  <?php }?>
                <td>
                  <?php if($p->status != 1) {?>
                   <button  data-index="<?php echo  $p->id ?>" class="badge badge-success seen_contact" ><i class="fa fa-eye"> Seen</i></button>
                  <?php }else { ?> 
                  <button disabled=""  class="badge badge-default" ><i class="fa fa-eye"> Seen</i></button>
                  <?php }?>
                 
                  <button data-index = "<?php echo $p->id ?>"  class="badge badge-danger delete_contact" ><i class="fa fa-trash-o"> Delete</i></button>
                  <button class="badge badge-primary" data-viewid="<?php echo $p->id ?>"  data-toggle="modal" data-target="#view_contact"><i class="fa fa-retweet"></i> view</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
</div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->
<script type="text/javascript">
$('#view_contact').on('show.bs.modal',function(e){
  id = $(e.relatedTarget).data('viewid');
  this1 = $(e.relatedTarget).parent().find('.seen_contact'); 

  $.ajax({
    type:'POST',
    url:'ajax.php',
    data:{'id':id,'view_feedback':'OK'},
    success:function(data){
      if(data != '') {
        $(e.currentTarget).find('#view_content').html(data);
        this1.prop('disabled', true);
        this1.attr('class','badge badge-default');
        this1.find('.fa-eye').html(' Seen');
        this1.parent().parent().find('.status').html('Seen');
        this1.parent().parent().find('.status').attr('class','badge badge-info');
      }
      
    }
  })
})
$(document).on('click','.delete_contact',function(){
  id = $(this).attr('data-index');
  this1 = $(this);
  console.log(id);
  if(confirm('Are you sure?')){
    $.ajax({
    type:'POST',
    url:'ajax.php',
    data:{'id':id,'delete_feedback':'OK'},
    success:function(data){
      if(data.trim() != 'error') {
        $('.search_feedback').html(data);
        $('.table_feedback').DataTable();
      }
    }
  })
  }
  
}) 
$(document).on('click','.seen_contact',function(){
  id = $(this).attr('data-index');
  this1 = $(this);
  console.log(id);
  $.ajax({
    type:'POST',
    url:'ajax.php',
    data:{'id':id,'seen_contact':'OK'},
    success:function(data) {
      console.log(data);
      if(data.trim() == 'success') {
        this1.prop('disabled', true);

        this1.attr('class','badge badge-default');
        this1.find('.fa-eye').html(' Seen');
        this1.parent().parent().find('.status').html('Seen');
        this1.parent().parent().find('.status').attr('class','badge badge-info');
        
      }
    }
  })
}) 
 
</script>

<script type="text/javascript">
  var checked = [];
  $(document).on('click','input[name=check_all_contact]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_contact[]"]').each(function(i,n){
        if($(n).is(':checked')) {
          checked.push(parseInt($(n).val()));
        } else {
          var i = checked.indexOf(parseInt($(n).val()));
          if(i != -1) {
            checked.splice(i,1);
          }
        }
      })
    } else {
      $('input:checkbox').prop('checked',false);
      $('input[name="check_contact[]"]').each(function(i,n){
        if($(n).is(':checked')) {
          checked.push(parseInt($(n).val()));
        } else {
          var i = checked.indexOf(parseInt($(n).val()));
          if(i != -1) {
            checked.splice(i,1);
          }
          
        }
      })
    }
    console.log(checked);



  })

  $(document).on('click','input[name="check_contact[]"]',function(){
    var thischeck = $(this) ;
    if(thischeck.is(':checked')) {
      checked.push(parseInt(thischeck.val()));
      console.log(checked);
    } else {
      var i = checked.indexOf(parseInt(thischeck.val()));
      if(i != -1) {
        checked.splice(i,1);
      }
    }
  })
  $(document).on('click','#delete_group_contact',function(){
    var requestData = JSON.stringify(checked);
    console.log(requestData);
    if(requestData == '[]') {
      alert('please choose feedback to delete');
    }
    else if(confirm('data will not be restore\nAre you sure')){
      var requestData = JSON.stringify(checked); //gửi requrest bằng mảng
      
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'list_id':requestData,'delete_group_feedback':'OK'},
        success:function(data){
            if(data.trim() != 'error'){
              $('.search_feedback').html(data);
              $('.table_feedback').DataTable(); 
            }
        }

      })
    } 
    
  })


</script>