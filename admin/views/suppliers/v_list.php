<?php require("include/report.php") ; ?>
<?php require("v_edit.php"); ?>

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header badge-info">
            <strong class="card-title"><i class="fa fa-list"></i> Suppliers</strong>
            <a class="btn btn-success"  data-toggle="modal" href="#add_supplier" ><i class="fa fa-plus-circle"></i> </a>
            <button class="btn btn-danger" id="del_supplier"  ><i class="fa fa-trash-o"></i> </a>

            </div>
           <hr style="boder:0.5px solid #fff">
           <div class="card-body" id="search_supplier">
            <table id="table_user" class="table table-striped table-bordered table_supplier">
              <thead>

                <tr>
                 <th><input type="checkbox" name="check_all_supplier"></th>
                 <th>STT</th>
                 <th>Supplier </br>Name</th>
                 <th>Address</th>
                 <th>Phone Number</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               <?php
               foreach($list_suppliers as $key=>$u):
                ?>
                <tr id="">
                 <td>
                  <input type="checkbox" name="check_supplier[]" value="<?php echo $u->id ?>">
                </td>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $u->name ?> </td>
                <td><?php echo $u->address ?></td>
                <td><?php echo $u->phone ?></td>
                <td>
                  <a class=" btn btn-primary" href="#edit_supplier" data-toggle="modal" data-index = "<?php echo $u->id?>"><i class="fa fa-edit"></i> </a>
                  <a class=" btn btn-danger delete_supplier" data-index = "<?php echo $u->id ?>"  id="delete_supplier"  href="javascript::void(0)"><i class="fa fa-trash-o"></i> </a>
                </td>
              </tr>
            <?php endforeach?>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
</div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->
<?php require("v_add.php"); ?>
<script type="text/javascript">
  $(document).on('click','.delete_supplier',function(){
    var id = $(this).data('index');
    if(confirm("data will not restore again, Are you sure?")){
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'delete_supplier':'OK'},
        success:function(data) {
          if(data.trim() == 'success') {
            window.location.reload();
          } else {
            alert('Fail delete supplier')
          }
        }
      })
    }
  })
  $(document).on('show.bs.modal','#edit_supplier',function(e){
    var id = $(e.relatedTarget).data('index');
    $(e.currentTarget).find('input[name="id_edit"]').val(id);
    $.ajax({
      type:'POST',
      url: 'ajax.php',
      dataType:'json',
      data:{'id':id,'get_supplier_by_id':'OK'},
      success:function(data){
        $(e.currentTarget).find('input[name="phone_edit"]').val(data.sup.phone);
        $(e.currentTarget).find('input[name="name_edit"]').val(data.sup.name);
        $(e.currentTarget).find('input[name="address_edit"]').val(data.sup.address);
      }
    })
  })
  $(document).ready(function(){
    $('.table_supplier').DataTable();
  })
  $(document).on('click','.delete_user',function(){
    id = $(this).attr('data-index');
    this1 = $(this);
    if(confirm("data will not restore again, Are you sure?")){
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'id':id,'delete_customer':'OK'},
        success:function(data) {
          if (data.trim() == "error") {
            alert("Error Delete");
          } else if(data.trim() == "permission") {
            alert('You dont have permission to do this action');
          } else {
            $('#search_user').html(data);
            $('.table_user').DataTable();
          }
        }
      })
    }
  })

  $('input[name=name_search]').on('keyup',function(){
    var name = $('input[name=name_search]').val();
    $.ajax({
      url: "ajax.php",
      type: 'POST',
      data: {'name':name,'search_customer':'OK'},
      success: function(data,status) {

       $('#search_user').html(data);
       $('.table_user').DataTable();
       
       
     }
   })
  });


  
</script>
<script type="text/javascript">
  var checked = [];
  $(document).on('click','input[name=check_all_supplier]',function(){
    checked = [];
    if($(this).is(':checked')) {
      $('input:checkbox').prop('checked',true);
      $('input[name="check_supplier[]"]').each(function(i,n){
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
      $('input[name="check_supplier[]"]').each(function(i,n){
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

  $(document).on('click','input[name="check_supplier[]"]',function(){
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
  $(document).on('click','#del_supplier',function(){
    var requestData = JSON.stringify(checked);
    console.log(requestData);
    if(requestData == '[]') {
      alert('please choose product to delete');
    }
    else if(confirm('data will not be restore\nAre you sure')){
      var requestData = JSON.stringify(checked); 
      console.log(requestData);
      $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'list_id':requestData,'delete_group_supplier':'OK'},
        success:function(data){
          if(data.trim() == "success") {
            window.location.reload();
          } else {
            alert('Fail delete suppliers');
          }
          // if(data.trim() == 'error'){
          //   alert("Error Delete");
          // } else if(data.trim() == "permission"){
          //   alert("You dont have permission to do this action");
          // } else {
          //   $('#search_supplier').html(data);
          //   $('.table_supplier').DataTable();
          // }
        }

      })
    } 
    
  })
</script>