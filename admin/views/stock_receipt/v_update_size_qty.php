<?php
include("include/report.php");
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="stock_receipt_list.php" style="color: blue">Stock Receipt</a></li>
    <li class="breadcrumb-item active" aria-current="page">update a product to stock</li>
</ol>
</nav>
<form method="POST" enctype="multipart/form-data" action="">
    <input type="hidden" name="stock_id" value="<?php echo $stock_id?>">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header badge-info">
                <h4><i class="fa fa-plus"></i> UPDATE A PRODUCT TO STOCK</h4>
            </div>
            <div class="card-body">
                <br><hr>

                <div id="content_update">
                 <?php
                 $size = json_decode($product->size);
                 $quantity = $product->quantity;
                 $detail = $m_stock->read_detail_by_stock_product($stock_id,$pro_id);
                 $status = 'New';
                 
                $show_size = "";
                if(count($size) > 0) {
                    $show_size .= "( ";
                    foreach($size as $key=>$s) {
                        $show_size .= $key ."=>" . $s ." ";
                    }
                    $show_size .= " )";
                }
                if($product->status == 0 ) {
                    $status = "Update Old Product";
                    $show_size .= '<span style="color:red"> [ + '.$detail->quantity.' ] </span>';
                }


                ?>
                <input type="hidden" name="pro_id" value="<?php echo $product->id?>">
                <div class="">
                    <div class="col-md-3">
                        <img src="public/images/<?php echo $product->image?>" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <p><b>Product Name:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $product->name ?></p>
                        </div>
                        
                        <div class="col-md-4">
                            <p><b>Price in:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p>$ <?php echo $product->price_in?></p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Price out:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p>$ <?php echo $product->price ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Status:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $status?> </p>
                        </div>
                        <div class="col-md-4">
                            <p><b>Quantity:</b></p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $quantity?> <?php echo $show_size ?> </p>
                        </div>

                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <?php if($product->status == 2) {?> <!-- sản phẩm mới thêm vào chưa được bán -->
                <div class="col-md-6">
                    <b>Price In:</b><input class="form-control" onkeyup="formatNumBerKeyUp(this)" type="text" name="price_in" value="<?php echo $product->price_in?>" >
                </div>

                <div class="col-md-6">
                    <b>Price Out:</b><input class="form-control" onkeyup="formatNumBerKeyUp(this)" type="text" name="price" value="<?php echo $product->price?>" >
                </div>
            <?php } ?>
            <div class="col-md-12"><b>Total quantity:</b><input class="form-control" <?php echo ($size == "")?"":"readonly"?> type="text" name="total_quantity" value="<?php echo $detail->quantity ?>" onkeypress="return isNumberKey(event)" ></div>

            <div class="clearfix"></div>
            <hr>

            <a href="javascript::void(0)" class="btn btn-secondary <?php echo ($size == "")?"disabled":"" ?>" id="add-sub-size"><i class="fa fa-plus"></i> Add size</a>
            <br><br>
            <div id="add-size">
                <?php 
                $sizes = json_decode($detail->size);
                if(count($sizes) != 0) {
                    foreach($sizes as $key=>$value){
                        ?>

                        <div class="row form-group">
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>
                            <div class="col-md-4">
                                <select name="size[]" class="form-control" id="select">
                                    <option <?php echo  ($key=="XS")?'selected':'' ?> value="XS">XS</option>
                                    <option <?php echo ($key=="S")?'selected':''  ?> value="S">S</option>
                                    <option <?php echo ($key=="M")?'selected':''  ?> value="M">M</option>
                                    <option <?php echo ($key=="L")?'selected':''  ?> value="L">L</option>
                                    <option <?php echo ($key=="XL")?'selected':''  ?> value="XL">XL</option>
                                    <option <?php echo ($key=="2XL")?'selected':''  ?> value="2XL">2XL</option>
                                    <option <?php echo ($key=="3XL")?'selected':''  ?> value="3XL">3XL</option>
                                </select>
                            </div>
                            <div class="col-md-1"><label for="text-input" class=" form-control-label">Quantity:</label></div>
                            <div class="col-md-4"><input type="text" value="<?php echo  $value ?>" required="required" onkeypress="return isNumberKey(event)" id="text-input" name="quantity[]" class="form-control"></div>
                            <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }}?>

                </div>
            </div>
        </div>

    </div>
    <div class="error_tmp">

    </div>

    <div style="text-align: center;">
        <button class="btn btn-danger" onclick="window.location= 'stock_receipt_list_products.php?id=<?php echo $stock_id?>'" type="button" value="Cancel"><i class="fa fa-reply"></i> Back</button>
        <button type="button" class="btn btn-info" name="update_stock_qty_size"  id="insert"> <i class="fa fa-thumbs-o-up"></i> Save</button>
    </div>
</div>

</div>
<!-- /# column -->

</form>
<script>
 $(document).on('click','#search_update_product',function(){
    pro_id = $('select[name=product_update_id]').val();
    stock_id = '<?php echo $stock_id?>';
    $.ajax({
        type:'POST',
        url:'ajax.php',
        data:{'pro_id':pro_id,'stock_id':stock_id,'search_update_product':'OK'},
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

    $('button[name="update_stock_qty_size"]').click(function(){
        var html = '';
        var flag = true;
        html += ' <ul  id="error" class="alert alert-danger">';
        price = $('input[name=price_in]').val();
        discount = $('input[name=price]').val();
        // console.log($('input[name=name]').val());

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
        if($('input[name=total_quantity]').val() == ""){
            html += '<li>quantity is required</li>';
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
        $('button[name="update_stock_qty_size"]').attr("type", "submit");
    } else {
        $('.error_tmp').html(html);
    }
    console.log(html);
})



</script>


