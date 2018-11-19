<div id="edit_supplier" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header  badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-plus MarginRight-10"></i>
        Create a new Supplier</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="error_add_sup">
                                       
        </div>

        <form id="form" method="POST" action="">
          <input type="hidden" name="id_edit">
         <div class="row form-group">
          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label><sup>*</sup></div>
          <div class="col-12 col-md-9"><input type="text" required="required" id="text-input" name="name_edit" class="form-control"></div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Address</label><sup>*</sup></div>
          <div class="col-12 col-md-9"><input type="text" required="required" id="text-input" name="address_edit" class="form-control"></div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone</label><sup>*</sup></div>
          <div class="col-12 col-md-9"><input type="text" required="required" id="text-input" name="phone_edit" class="form-control"></div>
        </div>


      </div>
      <div class="modal-footer ">
        <button type="button" name="update_sup" class="btn btn-info">
          <i class="fa fa-thumbs-up icon"></i> Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa fa-reply icon"></i> Back</button>
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

    $(document).on('click','button[name=update_sup]',function(){
      var flag = true;
      var html = '<ul  id="error" class="alert alert-danger">';
      if($('input[name=name_edit]').val() == '') {
        flag = false;
        html += '<li>Field name is required</li>';
      } 
      if ($('input[name=phone_edit]').val() == '') {
        flag = false;
        html += '<li>Field phone is required</li>';
      }
      if ($('input[name=address_edit]').val() == '') {
        flag = false;
        html += '<li>Field address is required</li>';
      } 
      if(flag) {
        $.ajax({
          type:'POST',
          url: 'ajax.php',
          data:{'name':$('input[name=name_edit]').val(),'phone':$('input[name=phone_edit]').val(),'address':$('input[name=address_edit]').val(),'id':$('input[name=id_edit]').val(),'edit_supplier':'OK'},
          success:function(data){
            if(data.trim() =="success") {
              window.location.reload();
            }  else {
              alert('Fail insert supplier');
            }

          }
        })
      } else {
        $('.error_add_sup').html(html);
      }
    })
  </script>
