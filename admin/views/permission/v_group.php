
<?php include("include/report.php"); ?>
<div class="container">
    <div class="card">
        <div class="card-header bg-success" style="text-align: center;">
            <h3><?php echo $permission->name ?></h3>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="per_id" value="<?php echo (empty($list_permission->per_id))?'':$list_permission->per_id ?>">
                <input type="hidden" name="id_group" value="<?php echo (empty($list_permission->id))?'':$list_permission->id ?>">
                <input hidden="hidden" name="id" value="<?php echo $permission->id ?>">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td width="10%"> </td>
                            <td><h4>List</h4></td>
                            <td><h4>Add</h4></td>
                            <td><h4>Edit</h4></td>
                            <td><h4>Delete</h4></td>
                            <td><h4>Others</h4></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list_product = $insert_product = $edit_product = $delete_product = "";
                        $list_category = $insert_category = $edit_category = $delete_category = "";
                        $list_user = $insert_user = $edit_user = $delete_user = "";
                        $list_per = $insert_permission = $edit_permission = $delete_permission = "";
                        $list_order = $edit_order = "";
                        $list_ship = $edit_ship = "";
                        
                        if($list_permission!=null) {
                            if($list_permission->list_product == 1) $list_product = 'checked';
                            if($list_permission->insert_product == 1) $insert_product = 'checked';
                            if($list_permission->edit_product == 1) $edit_product = 'checked';
                            if($list_permission->delete_product == 1) $delete_product = 'checked';

                            if($list_permission->list_category == 1) $list_category = 'checked';
                            if($list_permission->insert_category == 1) $insert_category = 'checked';
                            if($list_permission->edit_category == 1) $edit_category = 'checked';
                            if($list_permission->delete_category == 1) $delete_category = 'checked';

                            if($list_permission->list_user == 1) $list_user = 'checked';
                            if($list_permission->insert_user == 1) $insert_user = 'checked';
                            if($list_permission->edit_user == 1) $edit_user = 'checked';
                            if($list_permission->delete_user == 1) $delete_user = 'checked';

                            if($list_permission->list_permission == 1) $list_per = 'checked';
                            if($list_permission->insert_permission == 1) $insert_permission = 'checked';
                            if($list_permission->edit_permission == 1) $edit_permission = 'checked';
                            if($list_permission->delete_permission == 1) $delete_permission = 'checked';

                            if($list_permission->list_order == 1) $list_order = 'checked';
                            if($list_permission->edit_order == 1) $edit_order = 'checked';

                            if($list_permission->list_ship == 1) $list_ship = 'checked';
                            if($list_permission->edit_ship == 1) $edit_ship = 'checked';
                        }
                        ?>
                        <tr>
    
                            <td><h4>Products</h4></td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $list_product ?> name="list_product" type="checkbox" id="primary"   />
                                    <label for="primary"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $insert_product ?> name="insert_product" type="checkbox" id="info"   />
                                    <label for="info"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $edit_product ?> name="edit_product" type="checkbox"  id="edit_product"  />
                                    <label for="edit_product"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $delete_product ?> name="delete_product" type="checkbox" id="delete_product"  />
                                    <label for="delete_product"></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><h4>Categories</h4></td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $list_category ?> name="list_category" type="checkbox"  id="list_category" />
                                    <label for="list_category"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $insert_category ?> name="insert_category" type="checkbox"  id="insert_category" />
                                    <label for="insert_category"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $edit_category ?> name="edit_category" type="checkbox"  id="edit_category" />
                                    <label for="edit_category"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $delete_category ?> name="delete_category" type="checkbox"  id="delete_category" />
                                    <label for="delete_category"></label>
                                </div>
                            </td>                   
                        </tr>
                        <tr>
                            <td><h4>Users</h4></td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $list_user ?> name="list_user" type="checkbox"  id="list_user" />
                                    <label for="list_user"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $insert_user ?> name="insert_user" type="checkbox"  id="insert_user" />
                                    <label for="insert_user"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $edit_user ?> name="edit_user" type="checkbox"  id="edit_user" />
                                    <label for="edit_user"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $delete_user ?> name="delete_user" type="checkbox"  id="delete_user" />
                                    <label for="delete_user"></label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><h4>Permission</h4></td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $list_per ?> name="list_permission" type="checkbox"  id="list_permission" />
                                    <label for="list_permission"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $insert_permission ?> name="insert_permission" type="checkbox"  id="insert_permission" />
                                    <label for="insert_permission"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $edit_permission ?> name="edit_permission" type="checkbox"  id="edit_permission" />
                                    <label for="edit_permission"></label>
                                </div>
                            </td>
                            <td align="center">
                                <div class="checkbox icheck-primary">
                                    <input <?php echo $delete_permission ?> name="delete_permission" type="checkbox"  id="delete_permission" />
                                    <label for="delete_permission"></label>
                                </div>
                            </td>
                        </tr>
                        <tr style="border: none">
                            <td><h4>Order</h4></td>
                            <td colspan="3">
                                <div class="checkbox icheck-primary col-md-6">
                                    <input <?php echo $list_order ?> name="list_order" type="checkbox" id="list_order" />
                                    <label for="list_order">View</label>
                                </div>
                                <div class="checkbox icheck-primary col-md-6">
                                    <input <?php echo $edit_order ?> name="edit_order" type="checkbox" id="edit_order" />
                                    <label for="edit_order">Edit</label>
                                </div>
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                         <tr style="border: none">
                            <td><h4>Ship</h4></td>
                            <td colspan="3">
                                <div class="checkbox icheck-primary col-md-6">
                                    <input <?php echo $list_ship ?> name="list_ship" type="checkbox" id="list_ship" />
                                    <label for="list_ship">View</label>
                                </div>
                                <div class="checkbox icheck-primary col-md-6">
                                    <input <?php echo $edit_ship ?> name="edit_ship" type="checkbox" id="edit_ship" />
                                    <label for="edit_ship">Edit</label>
                                </div>
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="permission_list.php" class="btn btn-danger"><i class="fa fa-reply"></i> Back</a>
                <button type="submit" class="btn btn-info" name="edit_group"><i class="fa fa-thumbs-o-up"></i> Submit</button>
            </form>
        </div>
    </div>
</div>