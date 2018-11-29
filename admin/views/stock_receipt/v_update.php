<?php
include("include/report.php");
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="stock_receipt_list.php" style="color: blue">Stock Receipt</a></li>
    <li class="breadcrumb-item active" aria-current="page">update a product to stock</li>
</ol>
</nav>
<form method="POST" enctype="multipart/form-data" action="stock_receipt_store_product.php">
    <input type="hidden" name="stock_id" value="<?php echo $stock_id?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header badge-info">
                <h4><i class="fa fa-plus"></i> UPDATE A PRODUCT TO STOCK</h4>
            </div>
            <div class="card-body">
                <div class="row form-group">
                    <div class="col col-md-1"><label for="select" class=" form-control-label">Products:</label></div>
                    <div class="col-12 col-md-10">
                        <select name="product_update_id" required="required" id="" class="form-control selected2">
                            <?php foreach($products as $p): ?>
                            <option value="<?php echo $p->id ?>"><?php echo $p->name?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-1"><a href="javascript:;" id="search_update_product" class="btn btn-info"><i class="fa fa-search"></i></a></div>
                </div>
                <br><hr>

            <div id="content_update">

                    </div>
                </div>

            </div>

            <div style="text-align: center;">
                <button class="btn btn-danger" onclick="window.location= 'products_list.php'" type="button" value="Cancel"><i class="fa fa-reply"></i> Complete</button>
                <button type="submit" class="btn btn-info" name="insert_stock"  id="insert"> <i class="fa fa-thumbs-o-up"></i> Continue</button>
            </div>
        </div>

    </div>
    <!-- /# column -->

</form>
<script>
   $(document).on('click','#search_update_product',function(){
        pro_id = $('select[name=product_update_id]').val();
        $.ajax({
            type:'POST',
            url:'ajax.php',
            data:{'pro_id':pro_id,'search_update_product':'OK'},
            success:function(data) {
                $('#content_update').html(data);
            }
        })
   })
   $(document).ready(function(){
    var tmp_quantity = $('input[name="quantity[]"]');
    console.log(tmp_quantity.length);
    if(tmp_quantity.length == 0 ) {
        $('input[name=total_quantity').prop('disabled',false);
    } else {
        $('input[name=total_quantity').prop('disabled',true);
    }
})
</script>

<script type="text/javascript" >

    $(document).on('keyup','input[name="quantity[]"]',function(){ //cập nhật total khi tăng quantity

        console.log(1);
        total_quantity = 0;
        $('input[name="quantity[]"]').each(function(i,n){
            total_quantity += parseInt($(n).val());
        })
        var tmp_quantity = $('input[name="quantity[]"]');
        if(tmp_quantity.length == 0) {
            $('input[name=total_quantity]').prop('disabled',false);
        }

        $('input[name=total_quantity]').val(total_quantity);
    })

    $('#add-sub-image').on('click',function(){
        var html = '';
        html += '<div class="row form-group">';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Sub-Image:</label></div>';
        html += '<div class="col-md-10"><input type="file" id="text-input" name="sub_image[]" class="form-control"></div>';
        html += '<button type="button" class="close close-add-image" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        html += '</div>';
        $('.sub-image').append(html);
    });

    $('#discount').on('click',function(){
        if($('#discount').is(':checked')){
            $('input[name=reduce]').show();

        } else {
            $('input[name=reduce]').val('');
            $('input[name=reduce]').hide();
        }
    });

    $(document).on('click','#add-sub-size',function(){
        $('input[name=total_quantity]').prop('disabled',true);
        var html = '';
        html += ' <div class="row form-group">';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>';
        html += ' <div class="col-md-4">';
        html += ' <select name="size[]" class="form-control" id="select">';
        html += '<option value="XS">XS</option>';
        html += '<option value="S">S</option>';
        html += '<option value="M">M</option>';
        html += '<option value="L">L</option>';
        html += '<option value="XL">XL</option>';
        html += '<option value="2XL">2XL</option>';
        html += '<option value="3XL">3XL</option>';
        html += '</select>';
        html += ' </div>';
        html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>';
        html += '<div class="col-md-4"><input type="text" required="required" id="text-input" onkeypress="return isNumberKey(event)" name="quantity[]" class="form-control"></div>';
        html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        html += ' </div>';
        $('#add-size').append(html);
    })

    $(document).on('click', '.close-add-size', function () {
        $(this).parent().remove();
        total_quantity = 0;
        $('input[name="quantity[]"]').each(function(i,n){
            total_quantity += parseInt($(n).val());
        })
        var tmp_quantity = $('input[name="quantity[]"]');
        if(tmp_quantity.length == 0) {
            $('input[name=total_quantity]').prop('disabled',false);
        }
        
        $('input[name=total_quantity]').val(total_quantity);
    })
    $(document).on('click', '.close-add-image', function () {
        $(this).parent().remove();
    })

    $('button[name="insert_stock"]').click(function(){
        var html = '';
        var flag = true;
        html += ' <ul  id="error" class="alert alert-danger">';
        price = $('input[name=price_in]').val();
        discount = $('input[name=price]').val();
        // console.log($('input[name=name]').val());
        if($('#id_name').val() == "") {
            html += '<li>Name is required</li>';
            flag = false;
        }
        if($('input[name=price_in]').val() == ""){
            html += '<li>Price in is required</li>';
            flag = false;
        }
        if($('input[name=price]').val() == ""){
            html += '<li>Price out is required</li>';
            flag = false;
        }
        if(parseFloat(price) <= 0 || parseFloat(discount) <= 0) { 
            html += '<li>Price is the least one</li>';
            flag = false;
        }
        if(parseFloat($('input[name=price]').val()) < parseFloat($('input[name=price_in]').val()) ){
            html += '<li>Discount price out must be more than price in </li>';
            flag = false;
        }
        if($('input[name=intro]').val() == ""){
            html += '<li>Intro is required</li>';
            flag = false;
        }
        if($('input[name=total_quantity]').val() == "0"){
            html += '<li>quantity is required</li>';
            flag = false;
        }
        var file_data = $('#image').prop('files')[0];
        if(file_data == null) {
         html += '<li>Image is required</li>';
         flag = false;
     }
     var quantity = 0;
     $('input[name="quantity[]"]').each(function(i,n){ // nếu chưa nhập quantity
         if($(n).val() == "") {
            html += '<li>Please fill all quantity</li>';
            flag = false;
            return false;

        }
    })
     var check ;
     var len = $('select[name="size[]"').length;
     $('select[name="size[]"').each(function(i,n){
        $('select[name="size[]"').each(function(j,m){
            if($(n).val() == $(m).val() && len > 1 && i != j) {//nếu size bị trùng
                html += '<li>Size is unique</li>';
                flag = false;
                check = false; 
            }
            if(check == false)
            {
                return check;
            }
        });
        if(check == false) {
            return check;
        }

    }) ;

     html += '</ul>';
     console.log(flag);  
     if(flag) {
        $('button[name="insert_pro"]').attr("type", "submit");
    } else {
        $('.error_tmp').html(html);
    }
})



</script>


