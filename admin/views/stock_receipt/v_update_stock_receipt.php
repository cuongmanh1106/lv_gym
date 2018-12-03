<div id="update_stock_receipt" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header  badge-info">
        <h4 class="modal-title custom_align" id="Heading" style="text-align: left">
          <i class="fa fa-edit"></i>
        Update Stock Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form id="form" method="POST" action="">
          <input type="hidden" name="stock_id">
         <div class="row form-group">
          <div class="col col-md-2"><label for="textarea-input" class=" form-control-label">Status</label></div>
          <div class="col-12 col-md-10">
            <select name="stock_status" class="form-control">
              <option value="1">Confirmed</option>
              <option value="2">Cancel</option>
            </select>
          </div>
        </div>


      </div>
      <div class="modal-footer ">
        
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa fa-reply icon"></i> Back</button>
            <button type="button" name="update_status_stock" class="btn btn-info">
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

    $(document).on('click','button[name=update_status_stock]',function(){
      var stock_id = $('input[name=stock_id]').val();
      var status = $('select[name=stock_status]').val();
      var msg = '';
      if(status == "1") {
        msg = 'This status will make your stock display on website and you will not change this stock anymore !!! Are you sure?';
      } else if (status == "2") {
        msg = 'This status will cancel your stock receipt and can not be restore !!! Are you sure';
      }
      if(confirm(msg)) {
        $.ajax({
          type:'POST',
          url:'ajax.php',
          data:{'status':status,'stock_id':stock_id,'update_stock_receipt':'OK'},
          success:function(data) {
            window.location.reload();
          }
        })
      }
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

