<style type="text/css" rel="stylesheet">

    div{
        padding: 0;
    }


    .search-box{
        text-align: center;
        font-weight: bold;
        color: #636468;
        border-right: none;
        outline: none;
    }

    .btn-search{
        border-left: none;
        background: none;
        border-right: 2px solid #CBCCD0;
        border-top: 2px solid #CBCCD0;
        border-bottom: 2px solid #CBCCD0;
    }

    .btn-load-more{
        font-weight: bold;
        font-size: x-large;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
    }


</style>
<div class="content">

    <h4 class="text-center"><?php echo date('d F Y (l)')?></h4>

    <div class="row">
        <div class="col-12 text-center my-5">
            <label class="page-heading"><strong><?php if(isset( $active_subcategories[0]['category_name']))echo  $active_subcategories[0]['category_name'];?></strong></label>
            <a href="<?php echo site_url('all_category');?>" class="btn-back" style="color: #35C9A7"><i class="fas fa-chevron-left"></i> <?php echo $this->lang->line('back')?></a>
            <a href="<?php echo base_url('add_category')?>" class="btn-common" style="float:right"><?php echo $this->lang->line('add_category')?></a>
        </div>
    </div>

    <!--
    <div class="row">
        <div class="col-12">

        </div>
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control search-box" placeholder="SEARCH" aria-describedby="basic-addon">
                <div class="input-group-append">
                    <button class="input-group-btn btn-search" id="basic-addon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
-->

    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
<!--                    <th>CATEGORY</th>-->
                    <th><?php echo $this->lang->line('subcategory')?></th>
                    <th><?php echo $this->lang->line('added_date')?></th>
                    <th><?php echo $this->lang->line('action')?></th>
                </tr>
                </thead>
                <tbody>
                <?php $serial_number=0; foreach ($active_subcategories AS $active_subcategory){ ?>
                <tr>
                    <td><?php echo $serial_number+1; ?></td>
<!--                    <td>CATEGORY 1</td>-->
                    <td><?php echo $active_subcategory['subcategory_name']?></td>
                    <td><?php echo date_format(new DateTime($active_subcategory['subcategory_last_edited_date_time']),'d F Y'); ?></td>
                    <td>
                        <a href="#" onclick='update_subcategory(<?php echo json_encode($active_subcategories[$serial_number],JSON_HEX_APOS)?>,event)' class="action action-edit"><i class="far fa-edit"></i></a>
                        <a href="#" onclick='delete_subcategory(<?php echo json_encode($active_subcategories[$serial_number],JSON_HEX_APOS)?>,event)' class="action action-delete"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php $serial_number++; } ?>
                </tbody>
            </table>
        </div>

    </div>



</div>



<div class="modal fade" id="subcategory_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('update_subcategory_name')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_update_subctg">
                <div class="modal-body">
                    <input type="text" value="" class="form-control" name="text_update_subcategory_name"
                           id="text_update_subcategory_name">
                    <input type="hidden" value=""  name="text_update_subcategory_id"
                           id="text_update_subcategory_id">
                    <input type="hidden" value=""  name="text_update_category_id"
                           id="text_update_category_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-common"><?php echo $this->lang->line('update')?></button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- delete Modal -->
<div class="modal fade" id="delete_product_modal" tabindex="-1" role="dialog" aria-labelledby="delete_product_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $this->lang->line('delete_subcategory')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo site_url('delete_subcategory')?>">

                <div class="modal-body">
                    <?php echo $this->lang->line('are_you_sure_to_delete_this_subcategory')?> ???
                    <div class="row">
                        <div class="col-12 my-2"><input type="checkbox" name="product_delete" id="product_delete" class="mr-4"> <?php echo $this->lang->line('delete_product_also')?></div>
                        <input type="hidden" id="delete_subcategory" name="delete_subcategory">
                        <input type="hidden" id="category_id" name="category_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="btn_delete_category"><?php echo $this->lang->line('delete')?></button>

                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" rel="script">
    function update_subcategory(subcategory,event) {
        event.preventDefault();
//        alert(subcategory['ref_subcategory_category_id']);
        $('#text_update_subcategory_name').val(subcategory['subcategory_name']);
        $('#text_update_subcategory_id').val(subcategory['subcategory_id']);
        $('#text_update_category_id').val(subcategory['ref_subcategory_category_id']);
        $('#subcategory_update').modal('show');
    }


    function delete_subcategory(subcategory,event) {
        event.preventDefault();
        $('#delete_subcategory').val(subcategory['subcategory_id']);
        $('#category_id').val(subcategory['ref_subcategory_category_id']);
        $('#delete_product_modal').modal("show");
    }


    $('#form_update_subctg').validate({
        rules: {
            text_update_subcategory_name: {
                required: true,
                remote: {
                    url: '<?php echo site_url(uri_string());?>',

                    type: "post",
                    data:
                        {

                            update_subctg_name: function () {

                                return $("#text_update_subcategory_name").val();
                            },
                            update_ctg_id: function () {

                                return $("#text_update_category_id").val();
                            },
                            update_subctg_id: function () {

                                return $("#text_update_subcategory_id").val();
                            }

                        }
                }
            },
        },
        messages: {
            text_update_subcategory_name: '<?php echo $this->lang->line('type_unique_subcategory_name');?>',
        }
    });
</script>