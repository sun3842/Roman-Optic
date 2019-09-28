<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/app_assets/plugins//datetimepicker/jquery.datetimepicker.css')?>">
<style rel="stylesheet" type="text/css">
    .row>div{
        margin: 4px 0 12px 0;
    }

    .btn-load-more{
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }

    .category,.product{
        text-decoration: none;
        color: black;
    }

    .category:hover,.product:hover{
        text-decoration: none;
        color: black;
    }
    .img-product{
        width: 100%;
    }
    .clip-board-text{
        width: 100%;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid #34CAA7;
        outline: none;
    }
    .clip-board-btn{
        color: black;
        text-decoration: none;
        border-bottom: 1px solid black;
    }
    .clip-board-btn:hover{
        color: black;
        text-decoration: none;
    }

</style>
<script>
    var all_products_array=new Array();
    var p_same_id_index=new Array();
    var index=0;
    var index1=0;
</script>
<div class="content">
    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><?php echo $this->lang->line('product')?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="SEARCH" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input type="text" class="date-time-picker form-control" placeholder="Select Date">
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <select id="category">
                <option value=""><?php echo $this->lang->line('category')?></option>
            </select>
        </div>
        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <select id="sub_category">
                <option value=""><?php echo $this->lang->line('subcategory')?></option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped" id="product_table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th><?php echo $this->lang->line('name')?></th>
                    <th><?php echo $this->lang->line('category')?></th>
                    <th><?php echo $this->lang->line('subcategory')?></th>
<!--                    <th>QR CODE</th>-->
<!--                    <th>QUANTITY</th>-->
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                $last_product_id=0;
                foreach ($products AS $product) {

                    ?>
                    <script>
                        all_products_array[index]=<?php echo json_encode($product,JSON_HEX_APOS);?>;

                    </script>
                    <?php

                    if($last_product_id==$product["product_id"])
                    {

                        ?>

                    <script>
                        p_same_id_index[<?php echo $product["product_id"];?>]=p_same_id_index[<?php echo $product["product_id"];?>]+","+index.toString();

                        index=index+1;
                    </script>

                        <?php

                        continue;
                    }
                    else{
                        ?>
                        <script>
                            p_same_id_index[<?php echo $product["product_id"];?>]=index.toString();
                            index=index+1;
                        </script>

                        <?php
                        $last_product_id=$product["product_id"];
                    }
                    ?>
                <tr>
                    <td><?php echo $i+1;?></td>
                    <td><?php echo $product['product_unique_id']?></td>
                    <td><?php echo $product['product_name']?></td>
                    <td><a class="category" href="<?php echo base_url('all_subcategory')?>"><?php echo $product['category_name']?></a></td>
                    <td><?php echo $product['subcategory_name']?></td>
                    <td>
                        <a href="#" class="action action-view product" onclick='product(<?php echo $product["product_id"]?>,event)'><i class="fas fa-eye"></i></a>
                        <a href="<?php echo site_url('edit_product/'.$product['product_id'])?>" class="action action-edit"><i class="far fa-edit"></i></a>
                        <a href="#" class="action action-delete" onclick='delete_product(<?php echo $product["product_id"]?>,event)'><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php $i++; } ?>

                </tbody>
            </table>
        </div>
        <div class="col-12 text-center">
            <button type="button" class="text-paste btn-load-more" id="load_more_product"><i class="fas fa-angle-down"></i></button>
        </div>
    </div>
</div>

<!--- POP UP For viewing product Details-->
<div class="modal fade bd-example-modal-lg" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle"><?php echo $this->lang->line('product_details')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="product_full_details">
                </div>
            </div>

        </div>
    </div>
</div>

<!--- POP UP For viewing product Details-->


<!-- delete Modal -->
<div class="modal fade" id="delete_product_modal" tabindex="-1" role="dialog" aria-labelledby="delete_product_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_product')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('delete_category')?>">

                <div class="modal-body">
                    <?php echo $this->lang->line('are_you_sure_to_delete_this_product')?> ???
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger" id="btn_delete_product"><?php echo $this->lang->line('delete')?></a>

                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" rel="script" src="<?php echo base_url('assets/app_assets/plugins/datetimepicker/jquery.datetimepicker.full.js')?>"></script>

